<?php 
include("includes/connection.php");
if($_SESSION['user_id']==NULL)
{
    header("location:index.php");
}
if(isset($_GET['id']))
{
       $_SESSION['testid']=$id=$_GET['id'];
      
    $select=mysqli_query($conn,"select * from tests where id='".$_SESSION['testid']."'");
    //print_r($select);
    $row=mysqli_fetch_array($select);

}

include("frontend/head.php");
include("frontend/header.php");

?>
<body class="full-width login-body" oncopy="return false" oncut="return false" onpaste="return false">

 <!-- BEGIN #slider -->
<div  id="slider" class="section-container p-0 bg-white-darker">
    <!-- BEGIN carousel -->
    <div id="main-carousel" class="carousel slide" data-ride="carousel">
         <!-- BEGIN carousel-inner -->
         <div class="carousel-inner"> 
<!-- begin #content -->
            
          <section class="wrapper">
            
            <div class="row ">
                <div class="col-lg-4" >
                     <!--<div class="col-lg-4" ></div>-->
                    <div class="col-lg-12 nopadding ">
                        <section class="panel">
                            <header class="panel-heading">
                               Timer
                            </header>
                            <div class="panel-body" >
                                <!--<center>-->
                                <div class="clock flip-clock-wrapper">
                                    <span class="flip-clock-divider minutes">
                                        <span class="flip-clock-label">Minutes</span>
                                        <span class="flip-clock-dot top"></span>
                                        <span class="flip-clock-dot bottom"></span>
                                    </span>

                                    <ul class="flip "><li class="flip-clock-before"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">9</div></div><div class="down"><div class="shadow"></div><div class="inn">9</div></div></a></li><li class="flip-clock-active"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">0</div></div><div class="down"><div class="shadow"></div><div class="inn">0</div></div></a></li></ul>

                                    <ul class="flip "><li class="flip-clock-before"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">9</div></div><div class="down"><div class="shadow"></div><div class="inn">9</div></div></a></li><li class="flip-clock-active"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">0</div></div><div class="down"><div class="shadow"></div><div class="inn">0</div></div></a></li></ul>


                                    <span class="flip-clock-divider seconds">
                                        <span class="flip-clock-label">Seconds</span>
                                        <span class="flip-clock-dot top"></span>
                                        <span class="flip-clock-dot bottom"></span>
                                    </span>
                                    <ul class="flip ">
                                        <li class="flip-clock-before"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">9</div></div><div class="down"><div class="shadow"></div><div class="inn">9</div></div></a></li><li class="flip-clock-active"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">0</div></div><div class="down"><div class="shadow"></div><div class="inn">0</div></div></a></li>
                                    </ul>
                                    <ul class="flip ">
                                        <li class="flip-clock-before"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">9</div></div><div class="down"><div class="shadow"></div><div class="inn">9</div></div></a></li><li class="flip-clock-active"><a href="#"><div class="up"><div class="shadow"></div><div class="inn">0</div></div><div class="down"><div class="shadow"></div><div class="inn">0</div></div></a></li>
                                    </ul>

                                </div>
                                <!--</center>-->
                                <div class="message"></div>
                                <br/>
                                <center>
                                    <button id="start" type="button" name="start"class="btn btn-success">START TYPING</button>
                                </center>
                            </div>
                        </section>
                    </div>    
                </div>
                <div class="col-lg-8"  >
                    <div class="col-lg-12">
                        <span style="font-weight: bold;">Test Content</span>    
                        <span class="pull-right" style="font-weight: bold;"> <?php echo str_word_count($row['content']); ?>  Words  </span>    
                    </div>
                    <div class="col-lg-12" >
                        <section class="panel">
                           
                            <div class="typing-section switch_display panel-body">
                                <?php
                             $data= explode(' ',$row['content']);
                                     foreach ($data as $key => $value) {
                                        $firstClass = ($key == 0) ? 'highlight' : '';
                                        echo '<span data-id="'.$key.'" class="texttowrite '.$firstClass.'">'.$value.'</span> ';
                                     }  
                                ?>
                            </div>
                        
                        </section>
                    </div>
                     
                    <div class="col-lg-12" style="margin-bottom: 15px;" >
                        <input  style="color: black; height: 45px; font-size: 18px;" disabled="disabled" name="type" id="type" placeholder="Type Here..." class="form-control form-control-line">
                    </div>    
                </div> 
                <!--<div class="col-lg-3" >
                    <section class="panel">
                        <header class="panel-heading"   >Result
                        <div class="nextBtn pull-right">
                            <button onclick="location.href = 'enroll-test.php?id=<?php/* echo $_SESSION['testid']+1;*/?>'" type="button" class="btn btn-danger">Next</button>
                        </div>    
                        </header>
                        <div class="panel-body">
                            <p class="text-muted">Accuracy </p>
                            <h4 class="form-group" id="accuracy">NOT AVAILABLE
                            </h4>
                           
                            <p class="text-muted">Speed(WPM) </p>
                            <h4 class="form-group" id="speed">NOT AVAILABLE</h4>
                            
                            <p class="text-muted">Time </p>
                            <h4 class="form-group" id="time_result">NOT AVAILABLE</h4>
                        </div>
                    </section>
                </div>  
            </div>-->
        </section>
         

         </div>
        <!-- END carousel-inner -->
               
    </div>
    <!-- END carousel -->

 </div>
<!-- END #slider -->


<script type="text/javascript">
    var id = '<?php echo $id;?>';
    //var char    = '';

    function onComplete(accuracy, speed, time)
    {
        $.ajax({
            url: 'save-test-result.php',
            type: 'post',
            data: {'accuracy': accuracy, 'speed': speed, 'time': time},
            dataType: 'json',
            success: function (data) {
                console.log(data);
            },
        });
    }
</script>

    
<?php 
include("frontend/footer.php");
?>