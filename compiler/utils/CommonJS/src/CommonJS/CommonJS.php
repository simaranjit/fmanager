<?php
namespace CommonJS;

use JShrink;
use MattCG\cjsDelivery\Delivery;

/**
 * @author Simaranjit Singh <simaranjit.singh@virdi.me>
 */
class CommonJS {

    private $delivery;
    /**
     * @author Simaranjit Singh <simaranjit.singh@virdi.me>
     * CommonJS constructor.
     */
    public function __construct()
    {
        $includes = array('../source/modules');
        $this->delivery = Delivery::create(array('includes' => $includes));
        $this->delivery->addModule('../source/main');
        $this->delivery->setMainModule('../source/main');
    }

    /**
     * @author Simaranjit Singh <simaranjit.singh@virdi.me>
     *
     * @param bool $minify (OPTIONAL)
     *
     * @returns string
     */
    public function get ($minify = false) {
        $output = $this->delivery->getOutput();

        return $minify ? JShrink\Minifier::minify($output) : $output;
    }

    /**
     * @author Simaranjit Singh <simaranjit.singh@virdi.me>
     *
     * @param bool $minify (OPTIONAL)
     */
    public function save ($minify = false) {
        $output = $this->delivery->getOutput();

        file_put_contents('../js/script.js', $minify ? JShrink\Minifier::minify($output) : $output); ;
    }
}