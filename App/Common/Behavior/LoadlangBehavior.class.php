<?php
namespace Common\Behavior;

use Think\Behavior;

defined('THINK_PATH') or exit();

class LoadlangBehavior extends Behavior
{
    protected $options = array(
        'DEFAULT_LANG'     => 'zh-cn', // 当前语言包
        'LANG_SWITCH_ON'   => false, // 默认关闭语言包功能
        'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
        'LANG_LIST'        => 'zh-cn,en', // 允许切换的语言列表 用逗号分隔
        'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
    );

    // 行为扩展的执行入口必须是run
    public function run(&$params)
    {
        // 检测语言
        $this->checkLanguage($params);
    }

    /**
     * 语言检查
     * 检查浏览器支持语言，并自动加载语言包
     */
    private function checkLanguage(&$params)
    {
        // 不开启语言包功能，仅仅加载框架语言文件直接返回
        if (!C('LANG_SWITCH_ON')) {
            return;
        }
        $lang     = $group_lang = $module_lang = array();
        $lang_dir = LANG_PATH . C('DEFAULT_LANG');

        // 读取项目公共语言包
        if (is_file($lang_dir . '/common.php')) {
            $lang = include $lang_dir . '/common.php';
        }
        // 读取当前分组公共语言包
        if (defined('MODULE_PATH')) {
            $group_lang_file = MODULE_PATH . 'Lang/' . C('DEFAULT_LANG') . '/common.php';
            if (is_file($group_lang_file)) {
                $group_lang = include $group_lang_file;
            }
        }
        // 读取当前模块语言包
        $module_lang_file = MODULE_PATH . 'Lang/' . C('DEFAULT_LANG') . '/' . CONTROLLER_NAME . '.php';
        if (is_file($module_lang_file)) {
            $module_lang = include $module_lang_file;
        }

        $lang            = array_merge($lang, $group_lang, $module_lang);
        $js_lang         = isset($lang['js_lang']) ? $lang['js_lang'] : array();
        $module_js_lang  = isset($lang['js_lang_' . MODULE_NAME]) ? $lang['js_lang_' . MODULE_NAME] : array();
        $lang['js_lang'] = array_merge($js_lang, $module_js_lang);
        L($lang);
    }
}