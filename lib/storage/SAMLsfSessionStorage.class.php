<?php

class SAMLsfSessionStorage extends sfSessionStorage {
  public function shutdown()
  {
    // don't need a shutdown procedure because read/write do it in real-time
    // session_write_close();
    file_put_contents("/tmp/shutdown-".time(), microtime());
  }
}