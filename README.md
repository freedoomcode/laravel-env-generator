# laravel-env-generator
一个简单的 Laravel 扩展，根据 .env.example 生成适应不同环境的 .env 文件

## Composer 安装

```shell
composer require helingfeng/laravel-env-generator  
```

## 如何使用

配置文件 `.env.example` 定义模板
```
REST_API_URL=http://{{SCOPE}}-restful.com
```

执行生成 `.env` 脚本
```shell
php artisan env:build dev --scope=develop
```

测试结果
```
REST_API_URL=http://develop-restful.com
```
