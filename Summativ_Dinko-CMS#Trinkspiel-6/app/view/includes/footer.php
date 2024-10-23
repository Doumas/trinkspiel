<!-- Footer: Kontaktdaten -->
<div class="row col-12 bgwhite " style="padding-top: 50px;padding-bottom: 50px;">
    <div class="row m-auto">
        <div class="col-md-4 col-sm-12 m-auto" style="width: 300px;">
            <div class="m-auto logofooter" href="#"></div>
        </div>
        <div class="col-md-4 col-sm-12 m-auto" style="width: 300px;">
            <span class="small dark "> <u>Kontakt</u><br> Telefon:+49(0)123445566<br>
                Telefax:+49(0)123445599<br>
                E-Mail: doumas@outlook.de</span>
        </div>
        <div class="col-md-4 col-sm-12 m-auto" style="width: 300px;">
            <span class="small dark"> <u>Anschrift</u><br>
                Trinkspiel Gmbh<br>
                Web<br>
                Beispielstraße 26<br>
                60385 Frankfurt am Main</span>
        </div>
    </div>
</div>
</body>
<script>
    // Ajax Funktion fürs Trinkspiel
    $(document).ready(function() {
        // Button Click Event
        $(".answer").click(function() {
            let btn = this;
            // Fetching Button value & questionId
            let btnValue = btn.value;
            let questionId = $(".active span input").val();
            // jQuery Ajax Post Request
            $.post('backend/src/statistic.php', {
                btnValue: btnValue,
                questionId: questionId
            }, (response) => {
                // response from PHP back-end
                console.log(response);
            });
            $(".answer").prop("disabled", true);
            // Wird für die Web Applikation aufgebessert. Nutze prop für Text Ein/Ausblendung
            setTimeout(function() {
                //
                var active = $(".active");
                active.removeClass("active");
                active.next().addClass("active");
                if (t != 9)
                    $(".answer").prop("disabled", false);
            }, 2000);
            var t = $(".active").index();
        });
        $("#yes").on('click', function() {
            var number = 1 + Math.floor(Math.random() * 6);
            $('.active p').text(number + 'x Trinken!');
        });
    })

    // Bootstrap carousel intervall ausschalten
    $('.carousel').carousel({
        interval: false
    })

    $(document).ready(function() {
        // Search text
        var text = $('.errors').val();
        // Hide all content class element
        $('.content').hide();
        // Search and show
        $('.content:contains("' + text + '")').show();
    });
</script>

</html>