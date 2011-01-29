<?php
/**
 * Syslog helper.
 *
 * PHP Version 5
 *
 * @category   Ding
 * @package    Helpers
 * @subpackage Syslog
 * @author     Marcelo Gornstein <marcelog@gmail.com>
 * @license    http://www.noneyet.ar/ Apache License 2.0
 * @version    SVN: $Id$
 * @link       http://www.noneyet.ar/
 */
namespace Ding\Helpers\Syslog;

/**
 * Syslog helper.
 *
 * PHP Version 5
 *
 * @category   Ding
 * @package    Helpers
 * @subpackage Syslog
 * @author     Marcelo Gornstein <marcelog@gmail.com>
 * @license    http://www.noneyet.ar/ Apache License 2.0
 * @link       http://www.noneyet.ar/
 */
class SyslogHelper
{
    /**
     * Holds current ident used.
     * @var string
     */
    private $_ident;

    /**
     * Holds current syslog options.
     * @var integer
     */
    private $_options;

    /**
     * Holds current facility used.
     * @var integer
     */
    private $_facility;

    /**
     * Sets ident.
     *
     * @param string $ident Ident to use when logging.
     *
     * @return void
     */
    public function setIdent($ident)
    {
        $this->_ident = $ident;
    }

    /**
     * Sets syslog options.
     *
     * @param integer $options Syslog options. See php constants for these.
     *
     * @return void
     */
    public function setOptions($options)
    {
        $this->_options = $options;
    }

    /**
     * Sets syslog facility. See php constants for these.
     *
     * @param integer $facility Facility to use.
     *
     * @return void
     */
    public function setFacility($facility)
    {
        $this->_facility = $facility;
    }

    /**
     * Logs a LOG_EMERG message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function emerg($message)
    {
        $this->log(LOG_EMERG, $message);
    }

    /**
     * Logs a LOG_ALERT message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function alert($message)
    {
        $this->log(LOG_ALERT, $message);
    }

    /**
     * Logs a LOG_CRIT message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function critical($message)
    {
        $this->log(LOG_CRIT, $message);
    }

    /**
     * Logs a LOG_ERR message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function error($message)
    {
        $this->log(LOG_ERR, $message);
    }

    /**
     * Logs a LOG_WARNING message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function warning($message)
    {
        $this->log(LOG_WARNING, $message);
    }

    /**
     * Logs a LOG_NOTICE message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function notice($message)
    {
        $this->log(LOG_NOTICE, $message);
    }

    /**
     * Logs a LOG_INFO message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function info($message)
    {
        $this->log(LOG_INFO, $message);
    }

    /**
     * Logs a LOG_DEBUG message.
     *
     * @param string $message Message to log.
     *
     * @return void
     */
    public function debug($message)
    {
        $this->log(LOG_DEBUG, $message);
    }

    /**
     * Used internally to log whatever kind of message.
     *
     * @param integer $priority Priority to use.
     * @param string  $message  Message to log.
     *
     * @return void
     */
    protected function log($priority, $message)
    {
        syslog($priority, $message);
    }

    /**
     * Opens syslog.
     *
     * @return void
     */
    public function open()
    {
        openlog($this->_ident, $this->_option, $this->_facility);
    }

    /**
     * Closes syslog.
     *
     * @return void
     */
    public function close()
    {
        closelog();
    }

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
    }
}