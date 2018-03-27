# log

### 安裝

`composer require neji0924/log`

##### 設定 (Laravel >= 5.5 可略)

`config/app.php`:

```php
'providers' => [

    ... (略)

    Neji0924\Log\Providers\AppServiceProvider::class,
]
```

##### 資料庫

`php artisan migrate` 建立資料表`logs`

---

### 使用

##### trait

use `Neji0924\Log\Loggable`

```
<?php

namespace App;

use Neji0924\Log\Loggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Loggable;
}

```

##### 查看log

``` php
$article->logs // collection
```