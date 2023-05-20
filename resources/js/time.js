$(function() {

    let $worked = $("#count");

    function update() {
        let myTime = $worked.html();
        if(!myTime)
            return;
        let ss = myTime.split(":");
        let dt = new Date();
        dt.setHours(0);
        dt.setMinutes(ss[0]);
        dt.setSeconds(ss[1]);

        let dt2 = new Date(dt.valueOf() - 1000);
        let temp = dt2.toTimeString().split(" ");
        let ts = temp[0].split(":");

        $worked.html(ts[1]+":"+ts[2]);
        if($worked.html() == "00:00")
            $('#submit_test').submit();
        if($worked.html() == "00:30")
            $worked.css("color", "red");
        setTimeout(update, 1000);
    }

    setTimeout(update, 1000);

});
