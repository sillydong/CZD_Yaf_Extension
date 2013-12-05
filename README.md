CZD_Yaf_Extension
===============

建立在[Yaf](https://github.com/laruence/php-yaf) 的基础上，集成了Smarty引擎，加入了封装出来的各种功能类，位于APPLICATION_DIR/library下

【更新记录】
- 2013.12.05  
	加入命令行请求入口，请求示例：`php -f indexc.php "request_uri=/crontab/crontab/index"`  
	增加module的示例代码，包括后台及命令行，在模块的controllers同级目录建立views文件夹，模板文件放置及命名规则同APPLICATION_DIR/views文件夹
- 2013.10.14  
	格式化framework的代码，修复了framework的一处可能导致redeclare class的错误
- 2013.10.04  
	加入了[yaf_phpport](https://github.com/mzsolti/yaf-phpport)，方便使用虚拟空间的用户使用yaf框架

【功能说明】
- 缓存：APC/文件/Memcache/Xcache 源自 [prestashop](https://github.com/PrestaShop/PrestaShop)
- 数据库：MYSQLi/PDO/MYSQL 源自 [prestashop](https://github.com/PrestaShop/PrestaShop) ，可以通过配置mysql_cache_enable控制是否cache查询结果
- 邮件支持：PHPMailer+Vemplator，可以通过建立模板文件，用Vemplator渲染后发送邮件
- 淘宝SDK：Taobao/*，将淘宝公布的SDK按照Yaf加载规则稍作了修改
- Smarty：流行好用的视图引擎
- Blowfish/Rijndael：加解密算法
- Captcha：验证码生成工具
- Cookie：强化了安全性的Cookie
- Encoder：包含了部分加密算法
- Ftp：Ftp工具类
- ImageCombiner：图片拼接类，支持横向及纵向
- ImageManager：图片处理类
- JSMin：JS压缩
- Log：写日志
- Mail：封装好的发送邮件的静态函数
- MinifyHTML：HTML压缩
- Object：所有与数据库交互的Model都可以继承这个类，完成了add/update/delete/active操作，可以通过setData将数组赋值给类
- Pagination：分页
- PclZip：压缩打包
- PSCWS：分词，依赖于 [scws](http://www.xunsearch.com/scws/) ，需要另行安装
- Taobao：Taobao实例类，在define.inc.php设置好APP_KEY及APP_SECRET，通过Taobao::getInstance()使用
- Tools：一些常用静态方法
- Validate：常用验证方法
- Weixin：集成的微信接口

===============
其他具体信息详见代码

非科班出身未经历过大公司正规开发，代码风格奇葩，有任何问题，欢迎邮件联系傻东(njutczd+gmail.com)
