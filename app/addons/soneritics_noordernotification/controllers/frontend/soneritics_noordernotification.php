<?php
/*
 * The MIT License
 *
 * Copyright 2022 Jordi Jolink.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// https://domain/?dispatch=soneritics_noordernotification.action
if ($mode === 'action') {
    $settings = new SoneriticsNoOrderNotificationSettings();

    $minutesForNotification = date('H') >= 6 || date('H') < 1
        ? $settings->getNotifyAfterDaytime()
        : $settings->getNotifyAfterNight();

    $lastPaidOrderTimestamp = db_get_field("
        SELECT o.timestamp 
        FROM ?:orders o
        WHERE o.status IN('C', 'P')
        ORDER BY o.timestamp DESC");

    $minutesSinceLastPaidOrder = round((time() - $lastPaidOrderTimestamp) / 60);

    if ($minutesSinceLastPaidOrder > $minutesForNotification) {
        $messageBird = new \MessageBird\Client($settings->getApiKey());

        $message = new \MessageBird\Objects\Message();
        $message->originator = $settings->getOriginator();
        $message->recipients = [$settings->getPhone()];
        $message->body = "Er zijn geen bestellingen gedaan in de afgelopen {$minutesForNotification} minuten.";

        try {
            $messageBird->messages->create($message);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            echo 'Access key is unknown';
        } catch (\MessageBird\Exceptions\BalanceException $e) {
            echo 'No balance';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    fn_clear_ob();
    die('OK');
}
