<?php namespace LibUser\UserApi\Classes;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use October\Rain\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiError
{
    public static function response($exception, $statusCode = null)
    {
        $message = $exception->getMessage();

        $exceptionStatusCode = 500;
        if (method_exists($exception, 'getStatusCode')) {
            $exceptionStatusCode = $exception->getStatusCode();
        }

        if ($exception instanceof ModelNotFoundException) {
            $message = sprintf('%s not found',
                array_last(explode('\\', $exception->getModel()))
            );
            $exceptionStatusCode = 404;
        } elseif ($exception instanceof ValidationException) {
            $message = $exception->getErrors();
            $exceptionStatusCode = 422;
        } else {
            Event::fire('exception.report', [$exception]);
        }

        if ($statusCode) {
            $exceptionStatusCode = $statusCode;
        }

        return Response::make([
            'error'  => $message,
            'status' => $exceptionStatusCode,
        ], $exceptionStatusCode);
    }
}
