<!DOCTYPE html>
<html>
    <head><title>OOP Assign</title>
    <style>
        * {
            box-sizing: border-box;
        }
        #row {
            margin:0px;
            height:550px;
            padding:10px;
        }

        #f1{
            float:left;
            width:50%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            border-right:5px solid white;
        }
        #f2{
            float:left;
            width:50%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            border-left:5px solid white;
            
        }

        input[type=text],input[type=number] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit],input[type=button]  {
            width: 20%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        input[type=button]:hover {
            background-color: #45a049;
        }

        table{
            display:inline-block;
            border-collapse: collapse;
        }

        td{
            padding-left:30px;
            padding-right:30px;
        }
    </style>
    </head>
<body>
    <div id="row">
        <form id="f1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <h2 style="margin-top:0px;">For Student</h2>
            <label for="name">Name :</label>
            <input type="text" id="name" name="name" placeholder="Your name..">

            <label for="address">Address :</label>
            <input type="text" id="address" name="address" placeholder="Your address..">

            <label for="program">Program :</label>
            <input type="text" id="program" name="program" placeholder="Your program..">

            <label for="year">Year :</label>
            <input type="number" id="year" name="year" placeholder="Enter year..">

            <label for="fee">Fee :</label>
            <input type="text" id="fee" name="fee" placeholder="Enter fee(eg.45000.00)..">

            <input type="submit" name="submit" id="sub1" value="Submit">
            <input type="submit" name="show" id="show" value="Show student" style="width:30%;">
        </form>


        <form id="f2" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <h2 style="margin-top:0px;">For Staff</h2>
            <label for="name1">Name :</label>
            <input type="text" id="name1" name="name1" placeholder="Your name..">

            <label for="address1">Address :</label>
            <input type="text" id="address1" name="address1" placeholder="Your address..">

            <label for="year">School :</label>
            <input type="text" id="school" name="school" placeholder="Enter School..">

            <label for="fee">Pay :</label>
            <input type="text" id="pay" name="pay" placeholder="Enter Pay(eg.4500.00)...">

            <input type="submit" name="submit1" id="sub2" value="Submit">
            <input type="submit" name="show1" id="show" value="Show staff" style="width:30%;float:right;">
        </form>
    </div>
        <hr>
        <?php
                
                class Person {
                    public $name;
                    public $address;
                    public function __construct($name, $address) {
                    $this->name = $name;
                    $this->address = $address; 
                    }

                    function get_name() {
                        return $this->name;
                    }

                    function get_address() {
                        return $this->address;
                    }

                    function set_name($name) {
                        $this->name=$name;
                    }

                    function set_address($address) {
                        $this->address=$address;
                    }

                    public function personInfo() {
                        echo "Name is {$this->name}, Address is {$this->address}"; 
                    }

                }

                class Student extends Person {
                    public $program;
                    public $year;
                    public $fee;
                    public function __construct($program,$year,$fee) {
                    $this->program = $program;
                    $this->year = $year;
                    $this->fee = $fee;
                    }
                    public function showInfo() {
                    echo "Name is {$this->name}, Address is {$this->address}, Program is {$this->program}, Year is {$this->year} and Fee is {$this->fee}"; 
                    }
                }

                class Staff extends Person {
                    public $school;
                    public $pay;
                    public function __construct($school,$pay) {
                        $this->school = $school;
                        $this->pay = $pay;
                    }
                    public function showInfo() {
                        echo ", School is {$this->school} and Pay is {$this->pay}"; 
                    }
                 }


            if(isset($_POST['submit'])){
                
                $name = $_POST['name'];
                $add = $_POST['address'];
                $pro = $_POST['program'];
                $year =$_POST['year'];
                $fee = $_POST['fee'];
                
                $stu=new Student($pro,$year,$fee);
                $stu->set_name($name);
                $stu->set_address($add);
                $stu->showInfo();
                
                $arr=array("Name"=>$stu->get_name(),"Address"=>$stu->get_address(),"Program"=>$stu->program,"Year"=>$stu->year,"Fee"=>$stu->fee);
                $res=json_encode($arr);
                
                $myfile = fopen("stuinherit.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $res."\n");
                fclose($myfile);

            }


            if(isset($_POST['submit1'])){
                
                $name = $_POST['name1'];
                $add = $_POST['address1'];
                $school =$_POST['school'];
                $pay =$_POST['pay'];
                
                $person=new Person($name,$add);
                $staff=new Staff($school,$pay);
                $person->personInfo();
                $staff->showInfo();
                    
                $arr=array("Name"=>$person->name,"Address"=>$person->address,"School"=>$staff->school,"Pay"=>$staff->pay);
                $res=json_encode($arr);
                    
                $myfile = fopen("staffinhi.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $res."\n");
                fclose($myfile);
    
            }


            if(isset($_POST['show'])){
                $myfile = fopen("stuinherit.txt", "r") or die("Unable to open file!");

                echo "<table style='width:50%'>";
                echo "<tr>";
                echo "<td style='border:2px solid'>Name</td>";
                echo "<td style='border:2px solid'>Address</td>";
                echo "<td style='border:2px solid'>Program</td>";
                echo "<td style='border:2px solid'>Year</td>";
                echo "<td style='border:2px solid'>Fee</td>";
                echo "</tr>";

                while(!feof($myfile)) {
                    $st=fgets($myfile);
                    if($st!=""){
                        $obj=json_decode($st,true);
                        echo "<tr>";
                        array_walk($obj,"myfunction");
                        echo "</tr>";
                    }
                }
                fclose($myfile);
                echo "</table>";
            }
            

            if(isset($_POST['show1'])){
                
                $myfile = fopen("staffinhi.txt", "r") or die("Unable to open file!");
        
        
                echo "<table style='width:50%; float:right;'>";
                echo "<tr>";
                echo "<td style='border:2px solid'>Name</td>";
                echo "<td style='border:2px solid'>Address</td>";
                echo "<td style='border:2px solid'>School</td>";
                echo "<td style='border:2px solid'>Pay</td>";
                    
                echo "</tr>";
    
                while(!feof($myfile)) {
                    $st=fgets($myfile);
                    if($st!=""){
                        $obj=json_decode($st,true);
                        echo "<tr style='border:2px solid'>";
                        array_walk($obj,"myfunction");
                        echo "</tr>";
                    }
                }
        
                fclose($myfile);
                echo "</table>";
            }

            function myfunction($value,$key)
            {
                echo "<td style='border:2px solid'>".$value."</td>";
            }
            
    ?>

</body>
</html>
