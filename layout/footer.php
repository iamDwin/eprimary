

</div>
<!--
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">First link</a></li>
                    <li><a href="#">Second link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Third link</a></li>
                    <li><a href="#">Fourth link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Fifth link</a></li>
                    <li><a href="#">Sixth link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Other link</a></li>
                    <li><a href="#">Last link</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
              Premium and Open Source dashboard template with responsive and high quality UI. For Free!
            </div>
          </div>
        </div>
      </div>
-->
<?php if($access == 'student'){ ?>
<script>
    function dis(){
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","load/testactive.php?lecID=<?php echo $studentrow['level'];?>",false);
        xmlhttp.send(null);
        document.getElementById("testactive").innerHTML=xmlhttp.responseText;
    }
        dis();

        setInterval(function(){
            dis();
        },1000);
</script>
<?php }?>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">
                  <ul class="list-inline list-inline-dots mb-0">
<!--                    <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>-->
<!--                    <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>-->
                  </ul>
                </div>

              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2019 <a href="">eLearning</a>. All rights reserved.
            </div>
          </div>
        </div>
      </footer>
</div>
<!-- jQuery 3 -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
-->
<script>
    setTimeout(function() {
        $(".alert").alert('close');
    }, 8000);

  //  $('#example').DataTable();
</script>
  </body>
</html>
