<?php
/*
 * 文件上传
 */
namespace Admin\Controller;
use Think\Controller;

class UploaderController extends Controller {

	public function index() {
		$this -> display("base:uploadFrame");
	}
	
	/**
	 * 
	 */
	
	public function uploaderdel() {
		$result = 0;

		$url = str_replace(__ROOT__.'/', '', I('url'));
		
		$name = $_GET['name'];
	
		$mtime = $_GET['mtime'];
		
		if(file_exists($url)){
		
			if(unlink($url)) $result = 1;
		
		}
	
		echo $result;
		exit;
	}
	
	/*
	 * 显示上传文件夹中的内容
	 * 
	 * */
	
	public function uploaderList() {
		$config = C('WEB_UPLOADER');
		/* 判断类型 */
		switch ($_GET['type']) {

			/* 列出图片 */
			case 'Images' :
				$allowFiles = 'png|jpg|jpeg|gif|bmp';
				break;

			case 'Flash' :
				$allowFiles = 'flash|swf';
				break;

			/* 列出文件 */
			default :
				$allowFiles = '.+';
		}

		$path = $config['server']['uploadDir'];
		//echo file_exists($path);echo $path;echo '--';echo $allowFiles;echo '--';echo $key;exit;
		$listSize = 100000;

		$key = isset($_GET['key']) ? $_GET['key'] : '';

		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;

		/* 获取文件列表 */
		//	$path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
		$files = $this->getfiles($path, $allowFiles, $key);
		if (!count($files)) {
			echo json_encode(array("state" => "没有相关文件", "list" => array(), "start" => $start, "total" => count($files)));
			exit ;
		}

		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
			$list[] = $files[$i];
		}

		/* 返回数据 */
		$result = json_encode(array("state" => "SUCCESS", "list" => $list, "start" => $start, "total" => count($files)));
		
		echo $result;
	}

	/**
	 * 遍历获取目录下的指定类型的文件
	 * @param $path
	 * @param array $files
	 * @return array
	 */
	function getfiles($path, $allowFiles, $key, &$files = array()) {
		if (!is_dir($path))
			return null;
		if (substr($path, strlen($path) - 1) != '/')
			$path .= '/';
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path . $file;
				if (is_dir($path2)) {
					$this->getfiles($path2, $allowFiles, $key, $files);
				} else {
					if (preg_match("/\.(" . $allowFiles . ")$/i", $file) && preg_match("/.*" . $key . ".*/i", $file)) {
						$files[] = array('url' => __ROOT__.'/'.$path2, 'name' => $file, 'mtime' => filemtime($path2));
					}
				}
			}
		}
		return $files;
	}

	public function webuploader() {

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		$config = C('WEB_UPLOADER');

		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			exit ;
		}

		if (!empty($_REQUEST['debug'])) {
			$random = rand(0, intval($_REQUEST['debug']));
			if ($random === 0) {
				header("HTTP/1.0 500 Internal Server Error");
				exit ;
			}
		}

		@set_time_limit(5 * 60);

		$uploadDir = $config['server']['uploadDir'];

		$targetDir = $config['server']['uploadDirTemp'];

		$cleanupTargetDir = true;
		// Remove old files
		$maxFileAge = 5 * 3600;
		// Temp file age in seconds

		// Create target dir
		if (!file_exists($targetDir)) {
			@$this -> mkdirs($targetDir);
		}

		// Create target dir
		if (!file_exists($uploadDir)) {
			@$this -> mkdirs($uploadDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES[$config['client']['fileVal']]["name"];
		} else {
			$fileName = uniqid("file_");
		}
		//$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
		$filePath = $targetDir . '/' . $fileName;
		$uploadPath = $uploadDir . '/' . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;

		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . '/' . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}

		// Open temp file
		if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES[$config['client']['fileVal']]["error"] || !is_uploaded_file($_FILES[$config['client']['fileVal']]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES[$config['client']['fileVal']]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

		$index = 0;
		$done = true;
		for ($index = 0; $index < $chunks; $index++) {
			if (!file_exists("{$filePath}_{$index}.part")) {
				$done = false;
				break;
			}
		}
		if ($done) {
			if (!$out = @fopen($uploadPath, "wb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			}

			if (flock($out, LOCK_EX)) {
				for ($index = 0; $index < $chunks; $index++) {
					if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
						break;
					}

					while ($buff = fread($in, 4096)) {
						fwrite($out, $buff);
					}

					@fclose($in);
					@unlink("{$filePath}_{$index}.part");
				}

				flock($out, LOCK_UN);
			}
			@fclose($out);
		}

		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}

	public function mkdirs($dir) {

		if (!is_dir($dir)) {

			if (!$this -> mkdirs(dirname($dir))) {

				return false;

			}

			if (!mkdir($dir, 0777)) {

				return false;

			}

		}

		return true;

	}

}
?>
