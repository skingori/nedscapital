<!--main content end-->
<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        Ned Co @ 2017 All rights Reserved
        <a href="index.php#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/jquery-1.8.3.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../assets/js/jquery.scrollTo.min.js"></script>
<script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="../assets/js/jquery.sparkline.js"></script>


<!--common script for all pages-->
<script src="../assets/js/common-scripts.js"></script>

<script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="../assets/js/gritter-conf.js"></script>

<!--script for this page-->
<script src="../assets/js/sparkline-chart.js"></script>
<script src="../assets/js/zabuto_calendar.js"></script>

<script src="../custom/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="../custom/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<!--<script type="text/javascript">
    $(document).ready(function () {
    var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashgum!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
        // (string | optional) the image to display on the left
        image: 'assets/img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: true,
        // (int | optional) the time you want it to be alive for before fading out
        time: '',
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
    });

    return false;
    });
</script>-->
<script language="JavaScript">
    <!--
    function showpay() {
        if ((document.calc.loan.value == null || document.calc.loan.value.length == 0) ||
            (document.calc.months.value == null || document.calc.months.value.length == 0)
            ||
            (document.calc.rate.value == null || document.calc.rate.value.length == 0))
        { document.calc.pay.value = "Incomplete data";
        }
        else
        {
            var princ = document.calc.loan.value;
            var term  = document.calc.months.value;
            var intr   = document.calc.rate.value / 1200;
            document.calc.pay.value = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
        }

// payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))

    }

    // -->
</script>

<script type="application/javascript">
    $(document).ready(function () {
        $("#date-popover").popover({html: true, trigger: "manual"});
        $("#date-popover").hide();
        $("#date-popover").click(function (e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function () {
                return myDateFunction(this.id, false);
            },
            action_nav: function () {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [
                {type: "text", label: "Special event", badge: "00"},
                {type: "block", label: "Regular event", }
            ]
        });
    });


    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>

<script>
    function myFunction() {
        var loan = $('#amount').val(),
            month = $('#months').val(),
            int = $('#interest').val(),
            years = $('#years').val(),
            down = $('#down').val(),
            amount = parseInt(loan),
            months = parseInt(month),
            down = parseInt(down),
            annInterest = parseFloat(int),
            monInt = annInterest / 1200,
            calculation = ((monInt + (monInt / (Math.pow((1 + monInt), months) -1))) * (amount - (down || 0))).toFixed(2);

        document.getElementById("output").innerHTML = calculation;
    }


    $(function(){
        var month = $(this).val(),
            doneTypingInterval = 500,
            months = parseInt(month),
            typingTimer;

        $('#months').keyup(function(){
            month = $(this).val();
            months = parseInt(month);

            clearTimeout(typingTimer);
            if (month) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            $('#years').val(months/12);
        }
    })

    $(function(){
        var month = $(this).val(),
            doneTypingInterval = 500,
            months = parseInt(month),
            typingTimer;

        $('#months').keyup(function(){
            month = $(this).val();
            months = parseInt(month);

            clearTimeout(typingTimer);
            if (month) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            $('#years').val(months/12);
        }
    })

    $(function(){
        var year = $(this).val(),
            doneTypingInterval = 500,
            years = parseInt(year),
            typingTimer;

        $('#years').keyup(function(){
            year = $(this).val();
            myears = parseInt(year);

            clearTimeout(typingTimer);
            if (year) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            $('#months').val(year * 12);
        }
    })
</script>

</body>
</html>
