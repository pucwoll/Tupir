# PushNotification

## Installation
1. Copy files to `plugins/wintegration/firebasepush` directory
2. Install `plokko/laravel-firebase` package (command only install this package and its dependencies, not the whole project)
    ```bash
    composer update plokko/laravel-firebase --with-dependencies
    ```
3. Configure you Firebase account service json
    - Login to you firebase project
    - Go to Project -> Settings -> Service Accounts -> Firebase Admin SDK
    - Generate new private key and download it
    - Copy this JSON file to `storage/app/firebase-credentials.json`

## Usage
- Send message to all subscribers
  ```php
  FCM::notificationTitle('Testovná pushka pre všetkých')
      ->notificationBody('Testovné telo pushy')
      ->data(['notification' => 'data'])
      ->toCondition("!('none' in topics)")
      ->send()
  ```

- Send message to only topic subscribers
  ```php
  FCM::notificationTitle('Testovná pushka pre topic wezeo')
      ->notificationBody('Testovné telo pushy')
      ->data(['notification' => 'data'])
      ->toTopic('wezeo')
      ->send()
  ```
- Another FCM available methods https://github.com/plokko/laravel-firebase/blob/master/src/FcmMessageBuilder.php 
