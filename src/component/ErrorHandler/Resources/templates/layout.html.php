<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?=$this->pageTitle;?></title>
    <style><?=$this->pageStyle;?></style>
  </head>
  <body>
    <section class="wrapper">
      <h1><?=$this->message;?></h1>
      <p>
        <span class="file"><?=$this->description['file'];?></span>
        <span class="line"><?=$this->description['line'];?></span> throws
        <span class="class"><?=$this->description['class'];?></span>
      </p>

      <section class="trace">
        <h2>/* Stack trace */</h2>
        <ol><?php foreach ($this->trace as $key => $v): ?> 
          <li title="check args">
            <span class="file"><?=$v['file'];?></span>
            <span class="line"><?=$v['line'];?></span>
            <span class="class"><?=$v['class'];?></span>
            <span class="type"><?=$v['type'];?></span>
            <span class="function"><?=$v['function'];?></span>
            <pre><?=$v['args'];?></pre>
          </li>
          <?php endforeach;?>
        </ol>
      </section>
    </section>
    <footer class="footer">
      <span><?=VER_NAME;?></span>
      <span>&copy; <?=date('Y');?> <?=NAME;?></span>
    </footer>
    <script><?=$this->pageScript;?></script>
  </body>
</html>