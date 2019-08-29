<?php

interface Subject {
    public function attach($observable);
    public function detach($observer);
    public function notify();
}

interface Observer {
    public function handle();
}

class Login implements Subject {

    protected $observer = [];

    public function attach($observable)
    {
        if (is_array($observable)) {
             return $this->attachObservers($observable);
        }
        $this->observer[] = $observable;
    }

    public function detach($index)
    {
        unset($this->observer[$index]);
    }

    public function notify()
    {
        foreach ($this->observer as $observer) {
            $observer->handle();
        }
    }

    /**
     * @param $observable
     * @throws Exception
     */
    public function attachObservers($observable): void
    {
        foreach ($observable as $observer) {
            if (!$observer instanceof Observer) {
                throw new Exception();
            }
            $this->attach($observer);
        }
    }

    public function fire()
    {
        $this->notify();
    }
}

class LogHandler implements Observer {

    public function handle()
    {
        var_dump('log something important.');
    }
}

class EmailNotifier implements Observer {

    public function handle()
    {
        var_dump('fire off an email.');
    }
}

class LoginReporter implements Observer {

    public function handle()
    {
        var_dump('do some form of reporting');
    }
}

$login = new Login();
$login->attach([
    new LogHandler(),
    new EmailNotifier(),
    new LoginReporter()
]);

$login->fire();
