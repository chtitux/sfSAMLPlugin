<?php

class SAMLsfSessionStorage extends sfSessionStorage {
  public function shutdown()
  {
    // don't need a shutdown procedure because read/write do it in real-time
    // See http://trac.symfony-project.org/ticket/9021
    // SimpleSAMLPhp write in $_SESSION after exit() is called, so do NOT close 
    // PHP session.
    // So, the next line is commented
    // session_write_close();
  }
}