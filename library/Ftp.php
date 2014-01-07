<?php

class Ftp {
	protected $hostname = '';
	protected $username = '';
	protected $password = '';
	protected $port = '';
	protected $timeout = 30;
	protected $passive = true;
	protected $debug = false;
	protected $conn = false;

	protected $is_connected = false;

	function __construct($hostname, $username, $password, $debug = DEBUG_MODE, $port = '21', $passsive = true) {
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->port = $port;
		$this->passive = $passsive;
		$this->debug = $debug;

		if ($this->connect())
		{
			if ($this->login())
			{
				if ($this->passive)
				{
					@ftp_pasv($this->conn, true);
				}

				return $this->conn;
			}
			else
			{
				$this->close();
			}
		}

		return false;
	}

	function __destruct() {
		$this->close();
	}

	function connect() {
		if (!empty($this->hostname) && !empty($this->port))
		{
			if ($this->conn = @ftp_connect($this->hostname, $this->port, $this->timeout))
			{
				$this->is_connected = true;

				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError($this->hostname . ':' . $this->port . '无法连接'));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('缺少FTP信息'));
			}
		}

		return false;
	}

	function login() {
		if ($this->is_connected && !empty($this->username) && !empty($this->password))
		{
			if (@ftp_login($this->conn, $this->username, $this->password))
			{
				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError($this->username . ':' . $this->password . '无法登陆'));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('缺少FTP账号信息'));
			}
		}

		return false;
	}

	function close() {
		if ($this->is_connected)
		{
			if (@ftp_close($this->conn))
			{
				$this->is_connected = false;
				$this->conn = false;
			}
		}
	}

	function cd($path) {
		if ($this->is_connected && !empty($path))
		{
			if (@ftp_chdir($this->conn, $path))
			{
				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('无法切换目录:' . $path));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	function mkdir($path, $permission = null) {
		if ($this->is_connected && !empty($path))
		{
			if (@ftp_mkdir($this->conn, $path))
			{
				if ($permission != null)
				{
					$this->chmod($path, (int)$permission);
				}

				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('无法创建目录:' . $path));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	function mv($old_name, $new_name) {
		if ($this->is_connected && !empty($new_name) && !empty($old_name))
		{
			if (@ftp_rename($this->conn, $old_name, $new_name))
			{
				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('FTP MV失败'));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或文件名为空:' . $old_name));
			}
		}

		return false;
	}

	function cp() {

	}

	function ls($path) {
		if ($this->is_connected && !empty($path))
		{
			return @ftp_nlist($this->conn, $path);
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	function chmod($path, $permission) {
		if ($this->is_connected && !empty($path))
		{
			if (function_exists('ftp_chmod'))
			{
				if (@ftp_chmod($this->conn, $permission, $path))
				{
					return true;
				}
				else
				{
					if ($this->debug)
					{
						die(Tools::displayError('无法修改目录属性:' . $path . ':' . $permission));
					}
				}
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('无法使用ftp_chmod函数'));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	function size($path) {
		if ($this->is_connected && !empty($path))
		{
			return ftp_size($this->conn, $path);
		}

		return -1;
	}

	function rmfile($path) {
		if ($this->is_connected && !empty($path))
		{
			if ($result = @ftp_delete($this->conn, $path))
			{
				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('无法删除文件:' . $path));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	function rmdir($path) {
		if ($this->is_connected && !empty($path))
		{
			$files = $this->ls($path);
			if ($files && count($files) > 0)
			{
				foreach ($files as $file)
				{
					if (!@ftp_delete($this->conn, $file))
					{
						$this->rmdir($path);
					}
				}
			}
			if (@ftp_rmdir($this->conn, $path))
			{
				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('FTP删除目录失败:' . $path));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	function upload($file, $remote_path, $mode = 'auto', $permission = null) {
		if ($this->is_connected && !empty($remote_path))
		{
			if (file_exists($file))
			{
				if ($mode == 'auto')
				{
					$mode = $this->_settype(Tools::getFileExtension($file));
				}
				$mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;
				if (ftp_put($this->conn, $remote_path, $file, $mode))
				{
					if ($permission != null)
					{
						$this->chmod($remote_path, $permission);
					}

					return true;
				}
				else
				{
					if ($this->debug)
					{
						die(Tools::displayError('FTP上传失败:' . $file . ':' . $remote_path));
					}
				}
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('本地文件不存在:' . $file));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $remote_path));
			}
		}

		return false;
	}

	function download($remote_path, $file, $replace = true, $mode = 'auto') {
		if ($this->is_connected && !empty($path))
		{
			if ($mode == 'auto')
			{
				$mode = $this->_settype(Tools::getFileExtension($remote_path));
			}
			$mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;
			if (file_exists($file) && $replace)
			{
				unlink($file);
			}
			if (@ftp_get($this->conn, $file, $remote_path, $mode))
			{
				return true;
			}
			else
			{
				if ($this->debug)
				{
					die(Tools::displayError('FTP获取文件失败:' . $remote_path . ':' . $file));
				}
			}
		}
		else
		{
			if ($this->debug)
			{
				die(Tools::displayError('FTP未连接或目录为空:' . $path));
			}
		}

		return false;
	}

	private function _settype($ext) {
		if (empty($ext))
		{
			$ext = 'unknown';
		}
		$text_types = array(
				'txt',
				'text',
				'php',
				'phps',
				'php4',
				'js',
				'css',
				'htm',
				'html',
				'phtml',
				'shtml',
				'log',
				'xml'
		);

		return (in_array($ext, $text_types)) ? 'ascii' : 'binary';
	}
}
