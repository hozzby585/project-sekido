$(document).ready(function() {
    $("#repeatPassword").keyup(function() {
        if ($("#repeatPassword").val() === $("#inputPassword").val()) {
            document.getElementById("registerButton").style.display = "block";
            $("#repeatPassword")
                .addClass("is-valid")
                .removeClass("is-invalid");
        } else {
            document.getElementById("registerButton").style.display = "none";
            $("#repeatPassword")
                .addClass("is-invalid")
                .removeClass("is-valid");
        }
    });

    $(".modalButton").click(function() {
        var id = $(this)
            .closest("tr")
            .attr("id");
        var trId = "#" + id;
        var rowId = $(trId)
            .children(".rowID")
            .children(".custId")
            .val();

        var subject = $(trId)
            .children(".rowSub")
            .text();
        var description = $(trId)
            .children(".rowDesc")
            .text();
        var priority = $(trId)
            .children(".rowPrio")
            .text();
        var status = $(trId)
            .children(".rowStat")
            .text();
        var assign = $(trId)
            .children(".rowAssign")
            .text();

        if (assign == "None") {
            assign = "";
        }

        $("#SubModalId").val(subject);
        $("#DescModalId").val(description);
        $("#selectPrioId")
            .val(priority)
            .change();

        $("#selectStatId")
            .val(status)
            .change();
        $("#selectEmpId")
            .val(assign)
            .change();
        $("#custId")
            .val(rowId)
            .change();
    });

    $("#AddComment").click(function() {
        $("#showCommentBox").show();
    });
    $("#cancelComment").click(function() {
        $("#showCommentBox").hide();
        $(".AddComment").show();
    });

    $(".replyComment").click(function() {
        $("#showReplyBox").show();
    });
    $(".cancelReplyComment").click(function() {
        $("#showReplyBox").hide();
    });

    $(".viewTicketButton").click(function() {
        var id = $(this)
            .closest("tr")
            .attr("id");
        var rowId = "#" + id;

        var ticketId = $(rowId)
            .children("td")
            .children("input")
            .val();

        var getUrl = window.location;
        var baseUrl =
            getUrl.protocol +
            "//" +
            getUrl.host +
            "/" +
            getUrl.pathname.split("/")[1] +
            "/" +
            getUrl.pathname.split("/")[2];

        window.location = baseUrl + "/ticket/" + ticketId;
    });

    $(".statusUpdate").click(function() {
        var id = $(this)
            .closest("tr")
            .attr("id");
        var rowId = "#" + id;
        var tic_id = $(rowId)
            .children("td")
            .children(".hidden-ticket")
            .val();
        console.log(id);
        var status = $(rowId)
            .children("td")
            .children(".statusUpdate")
            .val();
        $("#ticket_id")
            .val(tic_id)
            .change();
        $("#status_id")
            .val(status)
            .change();
    });
    $(".statusUpdate2").click(function() {
        var id = $(this)
            .closest("tr")
            .attr("id");
        var rowId = "#" + id;
        var tic_id = $(rowId)
            .children("td")
            .children(".hidden-ticket")
            .val();

        var status = $(rowId)
            .children("td")
            .children(".statusUpdate2")
            .val();
        $("#ticket_id")
            .val(tic_id)
            .change();
        $("#status_id")
            .val(status)
            .change();
    });

    $(".userStatusButton").click(function() {
        console.log("asdasd");
        var id = $(this)
            .closest("tr")
            .attr("id");
        var rowId = "#" + id;
        var user_id = $(rowId)
            .children("td")
            .children(".hidden-id")
            .val();
        var user_status = $(rowId)
            .children("td")
            .children(".userStatusButton")
            .val();
        $("#_id")
            .val(user_id)
            .change();
        $("#_status")
            .val(user_status)
            .change();
    });
});
