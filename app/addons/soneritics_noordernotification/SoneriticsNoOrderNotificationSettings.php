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
class SoneriticsNoOrderNotificationSettings
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $originator;

    /**
     * @var int
     */
    private $notifyAfterDaytime;

    /**
     * @var int
     */
    private $notifyAfterNight;

    /**
     * SoneriticsKiyohSettings constructor.
     */
    public function __construct()
    {
        $this->apiKey = \Tygh\Registry::get('addons.soneritics_noordernotification.apikey');
        $this->phone = \Tygh\Registry::get('addons.soneritics_noordernotification.phone');
        $this->originator = \Tygh\Registry::get('addons.soneritics_noordernotification.originator');
        $this->notifyAfterDaytime = \Tygh\Registry::get('addons.soneritics_noordernotification.notify_after_daytime');
        $this->notifyAfterNight = \Tygh\Registry::get('addons.soneritics_noordernotification.notify_after_night');
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getOriginator()
    {
        return $this->originator;
    }

    /**
     * @return int
     */
    public function getNotifyAfterDaytime()
    {
        return $this->notifyAfterDaytime;
    }

    /**
     * @return int
     */
    public function getNotifyAfterNight()
    {
        return $this->notifyAfterNight;
    }
}
