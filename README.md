CZD_Yaf_Extension
===============

建立在[Yaf](https://github.com/laruence/php-yaf) 的基础上，集成了Smarty引擎，加入了封装出来的各种功能类，位于APPLICATION_DIR/library下

包含如下功能：
- 缓存：APC/文件/Memcache/Xcache 源自 [prestashop](https://github.com/PrestaShop/PrestaShop)
- 数据库：MYSQLi/PDO/MYSQL 源自 [prestashop](https://github.com/PrestaShop/PrestaShop)
- 邮件支持：PHPMailer+Vemplator，可以通过建立模板文件，用Vemplator渲染后发送邮件
- Smarty：流行好用的视图引擎
- Blowfish/Rijndael：加解密算法
- Captcha：验证码生成工具
- Cookie：强化了安全性的Cookie
- Encoder：包含了部分加密算法
- Ftp：Ftp工具类
- ImageManager：图片处理类
- JSMin：JS压缩
- Log：写日志
- MinifyHTML：HTML压缩
- Object：所有与数据库交互的Model都可以继承这个类，完成了add/update/delete/active操作
- Pagination：分页
- PclZip：压缩打包
- PSCWS：分词，依赖于 [scws](http://www.xunsearch.com/scws/) ，需要另行安装
- Tools：一些常用静态方法
- Validate：常用验证方法
- Weixin：集成的微信接口

===============
其他具体信息详见代码

非科班出身未经历过大公司正规开发，代码风格奇葩，有任何问题，欢迎邮件联系傻东(njutczd+gmail.com)
