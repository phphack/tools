<style>
form {
    display: block;
    float: left;
}
#content {
    float: left;
    margin-left: 50px;
}
</style>

<form name="calc" method="post">
    <p>本金：<input type="text" name="money" value="10000"> 元</p>
    <p>利率：<input type="text" name="rate" value="10"> %</p>
    <p>时间：<input type="text" name="year" value="3"> 年</p>
    <p><input type="submit"></p>
</form>
<div id="content"></div>

<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script>
$(function () {
    
    calc();
    
    $("form[name=calc]").submit(function (e) {
        e.preventDefault();
        calc();
    });
    
    function calc()
    {
        money = $("input[name=money]").val();
        rate = parseFloat($("input[name=rate]").val());
        year = $("input[name=year]").val();
        
        content = "";
        sum = money;
        
        for (i = 1; i <= year; i++) {
            sum = parseFloat((100 + rate) / 100 * sum).toFixed(2);
            content += "<p>第 " + i + " 年，本息和：" + sum + "</p>";
        }
        
        $("div#content").html(content);
    }
});
</script>