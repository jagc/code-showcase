<form id="search-form">
  <div class="row">
    <div class="first-row">
      <div class="six columns">
          <div class="ac">
            <label>AC No.</label>
            <input class="input-text u-full-width" type="email" placeholder=" " id="exampleEmailInput" name="ac_no">
          </div>
      </div>
      <div class="six columns">
        <div class="update">
          <label class="six columns example-send-yourself-copy">
            <input type="checkbox"  name="update_records" value="yes">
            <span class="label-body">Update records before search</span>
          </label>
        </div>
      </div>
    </div>
    <div class="clear"></div>

    <div class="second-row">
        <div class="six columns">
            <div class="date">
                <label for="datepicker">From:</label>

                <!-- From -->
                <div id="datetimepicker" class="input-append date">
            <input type="text" class="eleven columns input-text" name="from_date"></input>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
          </div>
          <script type="text/javascript"
           src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
          </script>
          <script type="text/javascript"
           src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
          </script>
          <script type="text/javascript"
           src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
          </script>
          <script type="text/javascript"
           src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
          </script>
          <script type="text/javascript">
            $('#datetimepicker').datetimepicker({
              format: 'dd/MM/yyyy hh:mm:ss',
              language: 'pt-BR'
            });
          </script>
            </div>
        </div>
        <div class="six columns">
            <div class="date">
                <label for="datepicker">To:</label>
                <!-- To -->
                <div id="datetimepicker2" class="input-append date">
            <input type="text" class="eleven columns input-text" name="to_date"></input>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
          </div>
          <script type="text/javascript"
           src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
          </script>
          <script type="text/javascript"
           src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
          </script>
          <script type="text/javascript"
           src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
          </script>
          <script type="text/javascript"
           src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
          </script>
          <script type="text/javascript">
            $('#datetimepicker2').datetimepicker({
              format: 'dd/MM/yyyy hh:mm:ss',
              language: 'pt-BR'
            });
          </script>
            </div>
        </div>
    </div>
    <div class="clear"></div>

    <div class="third-row">
    <input class="three columns button-primary" type="button" value="Submit" id="submit-form">
    <div class="loader"></div>
  </div>
  <div class="clear"></div>
  </div> <!-- row -->
</form>
