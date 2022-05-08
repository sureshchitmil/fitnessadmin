<?php

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

/**
 * @param  array $data
 *
 * @return  bool
 */
function sendPushNotification(array $data): bool
{
    $messaging = app('firebase.messaging');
    
    $notification = Notification::fromArray([
        'title' => $data['title'],
        'body'  => $data['content'],
        'data'         => [
            'id'                         => $data['id'],
            'title'                      => $data['title'],
            'content'                    => $data['content'],
            'push_notification_settings' => [],
        ]
    ]);

    foreach ($data['device_ids'] as $token) {
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification($notification);
        $messaging->send($message);
    }

    return true;
} 

