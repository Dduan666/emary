<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller
{
    public function test ()
    {
        $this -> display();
    }
    public function code ()
    {
        $config = array(
            'fontSize' => 30,    /*验证码字体大小 */
            'length'   => 4,     /*验证码位数 */
            'useNoise' => false,  /*关闭验证码杂点*/
        );
        ob_clean();
        $Verify = new \Think\Verify($config);
        $Verify -> entry();
    }
}