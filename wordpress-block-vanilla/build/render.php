<p <?php echo get_block_wrapper_attributes(); ?>>
<div id="staff-block-vanilla" style="overflow: hidden; max-width: 100%!important">

  <script>
  // Get each staff member created on the WP dashboard with the REST API and parse the data into a usable array
  const staff = JSON.parse( httpGet(window.location.origin + '/wp-json/wp/v2/br_person') );

  // Sort each staff member so that they are ordered to appear on the page alphabetically by the slug
  staff.sort(function(a, b){
    if(a.slug < b.slug) { return -1; }
    if(a.slug > b.slug) { return 1; }
      return 0;
    });

  // generate the code for each of the rows using the data retrieved for each staff member
  let theCode = '';
  staff.forEach(element => theCode += createRow(element));

  // Add the resulting code to the block
  const block = document.getElementById('staff-block-vanilla');
  block.innerHTML = theCode;

// function to generate a row to display in the block for each staff member
function createRow(item) {
  let thePermalink = item.link;
  let theName = item.cmb2.custom_fields.br_name;
  let theBio = item.cmb2.custom_fields.br_bio;
  let thePortrait = item.cmb2.custom_fields.br_portrait;
  let theTitle = item.cmb2.custom_fields.br_title;

  let theRow = `<div class="staff-member-div" style="float:left; width: 100%">
							<a href="` + thePermalink + `">
								<div style="float: left;">
									<img class="staff-portrait" src="` + thePortrait + `" style="width: 124px; margin: 0px auto" />
									<br />
									<p class="title-text" style="padding: 0px 0px 0px 0px!important; text-align: center;">` + theTitle + `</p>
								</div>
							</a>

				<div style="float: left;">
						<div class="name-text"><b>` + theName + `</b></div>
						<div class="bio-text">` + theBio + `</div>
				</div>

				</div>`;

  return theRow;
}

  // function to retrieve data from the WordPress REST API
  function httpGet(theUrl) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
  }
</script>

</div>
</p>
