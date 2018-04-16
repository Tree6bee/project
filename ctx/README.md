# Ctx_base
* [Introduction](#introduction)
* [Installation](#installation)
  * [Server Requirements](#server-requirements)
  * [Installing Ctx](#installing-ctx)
* [Usage](#usage)
  * [Defining Ctx Instance](#defining-ctx-instance)
  * [Defining Service](#defining-service)
  * [Interface Class](#interface-class)
  * [Child Module Class](#child-module-class)
  * [Defining Remote Method](#defining-remote-method)
  * [RPC Server](#rpc-server)
  * [Queue](#queue)
* [Service dispatch](#service-dispatch)
  * [In Ctx Module](#in-ctx-module)
  * [In Controller](#in-controller)
  * [In Bootstrap File](#in-bootstrap-file)

## Introduction

Ctx is a PHP service framework for building modular service.  Its modular development make it possible for modularity, extensibility, reusability, maintainability. It provides an unified interface to local and remote function calling.

Ctx is an MIT-licensed open source project. 

We recommend that you use Ctx handling all logic with Ctx modules. Controller classes or Cli script could be just used for taking request parameters, and their total behavior are performed by calling common service modules.

## Installation

### Server Requirements

The Ctx service framework has a few basic system requirements:

* PHP >= 5.3

But the Ctx basic module ( include db, cache, config, etc. ) has other system requirements, so it's highly recommended you make sure your server meets the following requirements:

* PHP >= 7
* PDO PHP Extension
* CURL PHP Extension

### Installing Ctx

Via composer create-Project

```
composer create-project tree6bee/ctx_base --no-dev
```

## Usage

### Defining Ctx Instance

#### Raw

Define Ctx in your bootstrap file. Like this:

```
require __DIR__ . '/ctx_base/vendor/autoload.php';

$ctx = \Ctx\Ctx::getInstance();
```

#### Via Controller

Alternatively, you may also define Ctx in your basic controller file. Like this:

```
require __DIR__ . '/ctx_base/vendor/autoload.php';

use Ctx\Ctx;

class Controller {
    /**
     * @var Ctx
     */
    protected $ctx;

    public function __construct()
    {
    	$this->ctx = Ctx::getInstance();
    }
}
```

## Defining Service

Service classes are stored in `/Service`, an service class is simply a business logic module. For example, let's assume our generated  `User` Service, first create directory called `User` , then create interface file called `Ctx.php` and child module file called `Photo.php` in `/Service/User/Child`directory.

### Interface Class

> Ctx.php

```
<?php

namespace Ctx\Service\User;

use Ctx\Basic\Ctx as BasicCtx;

/**
 * service interface
 */
class Ctx extends BasicCtx
{
    public function init()
    {
        //do some initialization work...
        //
    }

    private $photoObj = [];
    private function getPhotoObj($uid)
    {
        //load child module
        if (empty($this->photoObj[$uid])) {
            $this->photoObj[$uid] = $this->loadC('Photo', $uid);
        }

        return $this->photoObj[$uid];
    }

    public function getPhoto($uid)
    {
        return $this->getPhotoObj($uid)->get();
    }
}
```

### Child Module Class 

The class is autoloaded by using the *PSR-4* autoloader.

> Photo.php

```
<?php

namespace Ctx\Service\User\Child;

use Ctx\Basic\Ctx as BasicCtx;

/**
 *
 */
class Photo extends BasicCtx
{
    /**
     * @var $uid int user id
     */
    private $uid;

    /**
     * Photo constructor.
     * @param $uid int user id
     */
    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    public function get()
    {
        //do something for get user photo
    }
}
```

### Defining Remote Method

In some case, you may need to use **RPC**. The Ctx service framework provides an simply way to implement remote function calling . You may need to make sure the subclass class of `Tree6bee\Ctx\Basic\Ctx`, and configure the service module rpc.

```
protected $rpc = array(
    'host'      => 'http://ctx.sh7ne.dev/public/rpc.php',
    'method'    => array(
     	//'method name you want to use rpc',
    ),
);
```

Since you configure rpc, you must code with the rpc server. Below this we will let know how to handle rpc request at rpc server side.

***It's highly recommended you just define remote method in ctx service Interface file, otherwise you will get some result which is not your expectation.***

### RPC Server

You can handle ctx rpc quest like this:

```
<?php

//rpc server入口文件
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
require __DIR__ . '/../ctx_base/vendor/autoload.php';

$ctx = Ctx\Ctx::getInstance();
(new Tree6bee\Ctx\Rpc\Server)->run($ctx);
```

Of course, you can handle ctx rpc request in other way, and it is possible that you may even change the rpc implementation by extends `Tree6bee\Ctx\Basic\Ctx`.

### Queue

See [https://github.com/Tree6bee/queue](https://github.com/Tree6bee/queue)

## Service dispatch

Ctx service framework provides an unified interface to local and remote function calling:

```
$ctxInstance->moduleName->method(args...)
```

for example:

```
$ctx->User->getPhoto(123);
```

In different places, the ctx instance may be not similar.

### In Ctx Module 

In Ctx service module, the ctx instance has been defined as class property. With the Ctx instance you can invoke service module method easily.

```
$this->ctx->User->getPhoto(123);
```

### In Controller

If you have define ctx instance in controller class, you can invoke service module method with `$this->ctx` directly.

```
$this->ctx->User->getPhoto(123);
```

### In Bootstrap File

If you define Ctx in your bootstrap file Or similar situation, you may  invoke service module method like this:

```
$ctx->User->getPhoto(123);
```

## Code Organization

* web | m | api | admin | task

* ctx_base
