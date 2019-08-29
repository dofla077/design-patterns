<?php
require 'vendor/autoload.php';

use Acme\{Book, BookInterface, Kindle, eReaderAdapter, Nook};

class Person {
    public function read(BookInterface $book)
    {
        $book->open();
        $book->turnPage();
    }
}

(new Person)->read(new eReaderAdapter(new Nook()));