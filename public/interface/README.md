# interface

> A Vue.js project

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report
```

For a detailed explanation on how things work, check out the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).

# 前端运行环境


```
运行依赖:
node.js > 6.9.0
npm > 6.0.0
php > 7.1.0
```


### 1.安装node.js和npm/cnpm

> 安装node.js - http://nodejs.cn/download/

下载对应操作系统版本>6.9.0即可

> 使用npm

```
$ npm -v

$ npm install npm -g
```
运行查看npm版本,成功即可使用

> 修改npm使用淘宝源 - https://npm.taobao.org/

```
npm install -g cnpm --registry=https://registry.npm.taobao.org
```

使用淘宝源之后,注意项目中需要统一使用cnpm命令进行操作


### 2.安装项目依赖

进入项目里有package.json的文件夹内,运行命令安装项目开发所使用的依赖

> 安装依赖

```
$ cnpm install
```
等待安装完毕即可,安装过程中出现modules can't found 等问题使用单独安装命令安装即可
```
$ cnpm install --save moduleName
```


### 3.运行开发环境
依赖安装完毕之后,可以运行开发环境

> 运行开发环境

```
$ cnpm run dev
```


### 4.打包发布项目
把项目打包成生产环境下运行的文件

> 发布项目

```
$ cnpm run build
```
