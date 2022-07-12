<?php namespace LibChat\Comments\Http\Middlewares\Bindings;

use Closure;
use LibChat\Comments\Models\Comment;
use October\Rain\Exception\ApplicationException;

class ModelBind
{
    public function handle($request, Closure $next)
    {
        if ($request->route()->hasParameter('node') && is_numeric($request->route()->parameter('node'))) {
            $request->route()->setParameter('comment', Comment::findOrFail((int) $request->route()->parameter('node')));
            
            return $next($request);
        }
        
        if ($request->route()->hasParameter('comment')) {
            $request->route()->setParameter('comment', Comment::findOrFail((int) $request->route()->parameter('comment')));
            return $next($request);
        }
        
        if (!$request->route()->hasParameter('node') || !$request->route()->hasParameter('id')) {
            throw new ApplicationException('Parameter model or model_id not found in request.', 500);
        }
        
        if (!isset(config('libchat.comments::models_map')[$request->route()->parameter('node')])) {
            throw new ApplicationException('Model not allowed.', 500);
        }
        
        $config = config('libchat.comments::models_map')[$request->route()->parameter('node')];
        
        if (!isset($config['class'])) {
            throw new ApplicationException('Configuration file must define class for model ' . $request->route()->parameter('node') . '.', 500);
        }
        
        $request->route()->setParameter('node', [
            'class'           => $config['class'],
            'order_column'    => $config['order_column'] ?? 'created_at',
            'order_direction' => $config['order_direction'] ?? 'desc',
        ]);
        
        return $next($request);
    }
}