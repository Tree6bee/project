<?php

# usage:
#
# dispatch job: php tests/Service/Ctx/test_queue.php
# do job with daemon: php tests/Service/Ctx/test_queue.php 1

include __DIR__ . '/../../../vendor/autoload.php';

class ExampleJob extends \Ctx\Service\Ctx\Child\Queue\Job
{
    public $conn = 'default';

    public $tries = 2;

    /**
     * @var array
     */
    public $idArr;

    public function __construct(array $idArr)
    {
        $this->idArr = $idArr;
    }

    public function handle()
    {
        var_export($this->idArr);

        var_dump($this->retry_after, $this->tries);

        // throw new \Exception('handle job...lol ^_^');
    }
}

/** @var \Ctx\Ctx $ctx */
$ctx = \Ctx\Ctx::getInstance();

if (isset($argv[1])) {
    $ctx->Ctx->queueDaemon('default', '', 1);
} else {
    $ctx->Ctx->dispatch(new ExampleJob(['xx', 'oo']));
}
