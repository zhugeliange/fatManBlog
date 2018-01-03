# 这是个类似于QQ空间的个人博客

[项目演示地址](http://bg.fsociety.cn) 

*PS: 因为还没全做完，所以目前请访问如下地址:*

- [articel](http://www.fsociety.cn/articel) 

- [picture](http://www.fsociety.cn/picture) 

- [music](http://www.fsociety.cn/music) 

- [video](http://www.fsociety.cn/video) 

- [upload](http://www.fsociety.cn/upload) 

- [user](http://www.fsociety.cn/user) 

- [search](http://www.fsociety.cn/search) 

**框架解释 ：**

- 框架用的是我自己写的，基于 **MVC**，关键代码里都有说明。

- 并且前端我也利用 **jquery** 的 **extend** 封装了一些函数。

- 数据库驱动用的 [medoo](http://medoo.lvtao.net/) ，可以用 **pdo** 的。

- 模板用的 [twig](https://twig.symfony.com/)，**Smarty** 太老， **blade** 不太符合我的需求。

- 错误提示用的 [Whoops](http://filp.github.io/whoops/)，开发的时候更方便排错了。

- **log** 系统用的是 [seaslog](http://pecl.php.net/package/SeasLog)

- 文本内容显示用的是 [michelf](https://michelf.ca/projects/php-markdown/) 的 **markdown** 解析插件，然后配合 [fileinput](http://plugins.krajee.com/) 做表单处理。

- 文件上传部分加了个 [七牛云存储](https://www.qiniu.com/) ，数据库只存 **url**。

- 加了些防止 **SQL注入**， **敏感词过滤** 之类的函数。

- 全部样式是用的 [bootstrap](http://v3.bootcss.com/) ,从原型到数据库设计全都是我自己做的，所以丑就丑点吧Orz

**目录介绍 ：**

- **app** ： 项目的逻辑，经典的 **MVC** 分布。

	- **control** ： 业务处理逻辑，调用 **model** 并接受其返回的数据，经处理后交给 **view** 来显示。

	- **model** ： 承接数据库，专门用来处理相关的数据，并返回给 **control**。

	- **view** ： 接受 **control** 传过来的数据，将其按照要求展示出来。

- **cache** ： 缓存的静态视图文件。

- **core** ： 框架的核心目录。

	- **common** ： 框架相关函数。

		- **config.php** ： 处理加载配置文件。

		- **control.php** : 处理加载控制器文件。

		- **function.php** ： 框架加载用到的一些函数。

		- **log.php** ： 用来处理日志相关的函数。

		- **model.php** ： 处理加载模型文件。

		- **route.php** ： 框架的路由处理类，只支持两种形式：
		1. host/controller/action/parameter1_name/parameter1_vlaue/parameter2_name/parameter2_vlaue 
		2. host/controller/action?parameter1_vlaue=parameter1_vlaue&parameter2_vlaue=parameter2_vlaue

		- **seaslog.php** : **seaslog** 相关的函数。

	- **config** : 各种配置文件，每一类都写成一个单独的文件。

		- **database.php** ： 数据库的相关配置。

		- **key.php** ： 定义项目中一些公共的数据。

		- **log.php** ： 日志的相关配置。

		- **model.php** ： 模型的相关配置。

		- **qiniu.php** ： 七牛云存储的相关配置。

		- **route.php** ： 路由的相关配置。

	- **extend** ： 框架的一些额外的插件。

		- **filter.php** ： 敏感词过滤插件。

		- **key.txt** ： 预定义的一些敏感词。

		- **SQLProtect.php** ： 防止 **SQL注入** 做的一些处理，实际上用 **pdo** 已经可以不担心这个了。

	- **fsociety.php** : 框架的核心文件。

- **log** : 日志，分为文件形式和数据库形式。

- **static** ： 静态文件目录，因为还在开发中，所以这里我就没有加上压缩处理的模块。

- **vendor** ： **composer** 的包目录。

- **bom.php** :用来去掉项目中文件的 **bom** 头，为什么自己百度吧Orz

- **composer.json** ： **composer** 的配置文件。

- **fsociety.rp** : 这整个项目的 **Axure** 设计原型。

- **fsociety.sql** ： 项目的 **sql** ，包含测试数据。

- **index.php** : 项目的入口文件，做一些项目初始化时的配置。

**页面说明 ：**

- **首页 ：**

![fsociety16](http://oj6n9nf7i.bkt.clouddn.com/image/testfsociety16.jpg)

- **登录/注册页面**

![fsociety2](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety2.jpg)

![fsociety3](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety3.jpg)

- **文章列表页面 ：**

![fsociety4](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety4.jpg)

- **图片列表页面**

![fsociety17](http://oj6n9nf7i.bkt.clouddn.com/image/testfsociety17.jpg)

- **音乐列表页面**

![fsociety6](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety6.jpg)

- **视频列表页面**

![fsociety7](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety7.jpg)

- **作品详情页面**

![fsociety8](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety8.jpg)

- **搜索结果页面**

![fsociety9](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety9.jpg)

- **作品上传页面**

![fsociety10](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety10.jpg)
![fsociety11](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety11.jpg)
![fsociety12](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety12.jpg)
![fsociety13](http://oj6n9nf7i.bkt.clouddn.com/image/test/fsociety13.jpg)

- **用户详情页面**

![fsociety15](http://oj6n9nf7i.bkt.clouddn.com/image/testfsociety15.jpg)

*这个其实是很久以前写的了，当时写到评论模块的时候刚好那段时间比较忙，后来一直有各种事情，所以项目就拖着了。等到以后有时间在一点一点补上吧Orz，当然这次得把整体升级下，我最近在写一个高大上的框架，等到全部搞定了刚好可以用这个项目做实践：）* 
