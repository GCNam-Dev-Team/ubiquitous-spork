<?php
class Main_model extends CI_Model
{

	function __construct()
	{
		//parent::CI_model();
	}
	public function settings()
	{
		$this->db->from('settings');
		$this->db->where('comp_id', COMPANY_ID);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_home_posts($title)
	{
		$v = '';

		$this->db->limit(3);
		$this->db->select("*, posts.body AS 'story'");
		$this->db->join('images', 'post_id = main_id', 'left');
		$this->db->order_by('posts.date', 'DESC');
		$query = $this->db->get_where(
			'posts',
			array(
				'posts.comp_id' => COMPANY_ID,
				'images.comp_id' => COMPANY_ID,
				'status' => 'active',
				'page' => 'post'
			)
		);


		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<div class="col-lg-4 d-flex ftco-animate">
							<div class="blog-entry justify-content-end">
								<a title="' . $title . ' - ' . $row->title . ' post" href="' . base_url('post/' . $row->slug) . '" class="block-20" style="background-image: url(\'' . CMS . 'assets/images/' . $row->file . '\');"></a>
								<div class="text d-flex float-right d-block">
									<div class="topper text-center pt-4 px-3">
										<span title="' . $title . ' - ' . $row->title . ' post" class="day">' . substr($row->date, 8, 2) . '</span>
										<span title="' . $title . ' - ' . $row->title . ' post" class="mos">' . $this->month(substr($row->date, 5, -12)) . '</span>
										<span title="' . $title . ' - ' . $row->title . ' post" class="yr">' . substr($row->date, 0, 4) . '</span>
									</div>
									<div class="desc p-4">
										<h3 title="' . $title . ' - ' . $row->title . ' post" class="heading mt-2"><a href="' . base_url('post/' . $row->slug) . '">' . $row->title . '</a></h3>
										<p title="' . $title . ' - ' . $row->title . ' post">' . word_limiter(strip_tags($row->story), 10) . '</p>
									</div>
								</div>
							</div>
						</div>';
			}
		} else {
			$v = '	<div class="col-lg-4 d-flex ftco-animate">
						<div class="blog-entry justify-content-end">
							<a  title="' . $title . ' -  post" href="#" class="block-20" style="background-image: url(\'' . base_url('assets/images/church_side.JPG') . '\');">
							</a>
							<div class="text d-flex float-right d-block">
								<div class="topper text-center pt-4 px-3">
									<span title="' . $title . ' - post" class="day">' . date('d') . '</span>
									<span title="' . $title . ' - post" class="mos">' . $this->month(date('m')) . '</span>
									<span title="' . $title . ' - post" class="yr">' . date('Y') . '</span>
								</div>
								<div class="desc p-4">
									<h3 title="' . $title . ' - post" class="heading mt-2"><a href="#">There are currently no stories</a></h3>
									<p title="' . $title . ' - post">There are currently no stories!</p>
								</div>
							</div>
						</div>
					</div>';
		}

		echo $v;
	}
	public function get_post($slug)
	{
		$this->db->limit(1);
		$this->db->select("*, posts.body AS 'story'");
		$this->db->join('images', 'post_id = main_id', 'left');
		$query = $this->db->get_where(
			'posts',
			array(
				'posts.comp_id' => COMPANY_ID,
				'images.comp_id' => COMPANY_ID,
				'status' => 'active',
				'page' => 'post',
				'slug' => $slug,
			)
		);
		return $query->row_array();
	}
	public function get_cat_by_id($cat_id)
	{
		$this->db->limit(1);
		$query = $this->db->get_where(
			'categories',
			array(
				'comp_id' => COMPANY_ID,
				'cat_id' => $cat_id,
			)
		);
		if ($query->result()) {

			foreach ($query->result() as $row) {
				echo $row->cat_name;
			}
		} else {
			echo 'No Category!';
		}
	}
	public function get_testimonials($title)
	{
		$this->db->limit(5);
		$this->db->order_by('rand()');
		$this->db->join('images', 'testimonial_id = main_id', 'left');
		$query = $this->db->get_where('testimonials', array('testimonials.comp_id' => COMPANY_ID, 'images.comp_id' => COMPANY_ID, 'status' => 'active', 'page' => 'testimonial'));
		$v = '';

		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<div class="item">
							<div class="testimony-wrap text-center py-4 pb-5">
								<div class="user-img mb-4" style="background-image: url(' . CMS . 'assets/images/' . $row->file . ')">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text p-3">
									<p title="' . $title . ' - ' . $row->name . ' Testimonial Quote' . '" class="mb-4">' . $row->quote . '</p>
									<p title="' . $title . ' - ' . $row->name . ' Testimonial' . '" class="name">' . $row->name . '</p>
									<span class="position">' . $row->position . '</span>
								</div>
							</div>
						</div>';
			}
		} else {
			$v = '	<div class="item">
						<div class="testimony-wrap text-center py-4 pb-5">
							<div class="user-img mb-4" style="background-image: url(' . base_url('assets/images/user.png') . ')">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text p-3">
								<p class="mb-4">There are currently no testimonials</p>
								<p class="name">Website Admin</p>
								<span class="position">Website Admin</span>
							</div>
						</div>
					</div>';
		}

		echo $v;
	}
	public function get_categories($title)
	{
		$this->db->order_by('cat_name', 'ASC');
		$query = $this->db->get_where(
			'categories',
			array(
				'comp_id' => COMPANY_ID,
				'type' => 'post'
			)
		);
		$v = '';

		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '<li><a title="' . $title . ' - Category' . '" href="' . base_url('pages/posts/' . $row->cat_id) . '">' . $row->cat_name . ' <span class="ion-ios-arrow-forward"></span></a></li>';
			}
		} else {
			$v = $v .= '<li><a href="#">No Available Categories <span class="ion-ios-arrow-forward"></span></a></li>';
		}

		echo $v;
	}
	function newsletter()
	{
		$query = $this->db->get_where('subscribers', array('email' => $this->input->post('email')));
		if (empty($query->row_array())) {
			$data = array('comp_id' => COMPANY_ID, 'email' => $this->input->post('email'));
			if ($this->db->insert('subscribers', $data)) {
				return true;
			} else {
				return false;
			}
		} else {
			echo 'Email is already listed!';
			die();
		}
	}
	function get_upcoming_event()
	{
		$this->db->limit(1);
		$this->db->join('departments', 'events.department_id = departments.department_id', 'left');
		$this->db->order_by('starting_date', 'DESC');
		return $this->db->get_where('events', array(
			'events.comp_id' => COMPANY_ID,
			'departments.comp_id' => COMPANY_ID,
			'starting_date' > date('Y-m-d h:i:s'),
			'status' => 'active'
		))->row_array();
	}
	public function get_beliefs($title)
	{
		$s = '';
		$i = 1;
		$iconPlace = 'order-lg-last';
		$align = 'right';
		$padding = 'pr-lg-5';

		$this->db->join('icons', 'services.service_id = icons.main_id', 'left');
		$query = $this->db->get_where(
			'services',
			array(
				'icons.comp_id' => COMPANY_ID,
				'status' => 'active'
			)
		);


		if ($query->result()) {
			foreach ($query->result() as $row) {
				if ($i == 1 || fmod($i, 5) == 0) {
					$s .= '<div class="col-lg-6">';
				}

				$s .= '	<div class="d-flex services ftco-animate text-lg-' . $align . '">
							<div class="icon ' . $iconPlace . ' d-flex align-items-center justify-content-center"><span class="' . $row->icon . '"></span></div>
							<div class="media-body ' . $padding . '">
								<h3 title="' . $title . ' - ' . $row->name . ' Core Belief" class="heading mb-3">' . $row->name . '</h3>
								<p title="' . $title . ' - ' . $row->name . ' Core Belief">' .  substr($row->short_body, 0, 150) . '...</p>
							</div>
						</div>
					';

				if (fmod($i, 4) == 0) {
					$s .= '</div>';
					$iconPlace = '';
					$align = 'left';
					$padding = 'pl-lg-5';
				}
				$i++;
			}
		} else {
			$s = 'There are services!';
		}

		echo $s;
	}
	function get_last_sermon()
	{
		$this->db->limit(1);
		$this->db->select("*, posts.body AS 'story'");
		$this->db->join('images', 'post_id = main_id', 'right');
		$this->db->join('categories', 'posts.category_id = categories.cat_id', 'left');
		$this->db->order_by('posts.date', 'DESC');
		return $this->db->get_where('posts', array(
			'categories.comp_id' => COMPANY_ID,
			'posts.comp_id' => COMPANY_ID,
			'images.comp_id' => COMPANY_ID,
			'cat_name' => 'Sermons',
			'starting_date' < date('Y-m-d h:i:s'),
			'status' => 'active',
			'page' => 'post'
		))->row_array();
	}
	function get_events()
	{
		$v = '';
		$this->db->limit(3);
		$this->db->join('departments', 'events.department_id = departments.department_id', 'right');
		$this->db->join('images', 'events.event_id = images.main_id', 'left');
		$this->db->order_by('starting_date', 'DESC');
		$query = $this->db->get_where('events', array(
			'images.comp_id' => COMPANY_ID,
			'departments.comp_id' => COMPANY_ID,
			'events.comp_id' => COMPANY_ID,
			'starting_date' < date('Y-m-d h:i:s'),
			'status' => 'active',
			'page' => 'event'
		));
		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<div class="event-wrap d-md-flex ftco-animate">
							<div class="img" style="background-image: url(' . CMS . 'assets/images/' . $row->file . ');"></div>
							<div class="text pl-md-5">
								<h2 class="mb-3"><a href="#">' . $row->title . '</a></h2>
								<div class="meta">
									<p>
										<span><i class="icon-calendar mr-2"></i> ' . $row->starting_date . ' - ' . $row->ending_date . ' </span>
										<span><i class="icon-my_location mr-2"></i> <a href="#">' . $row->location . '</a></span>
										<span><i class="icon-location_city mr-2"></i> ' . $row->department_name . '</span>
									</p>
								</div>
								<p><a href="#" class="btn btn-primary">Read more</a></p>
							</div>
						</div>';
			}
		} else {
			$v .= '	<div class="event-wrap d-md-flex ftco-animate">
						<div class="img" style="background-image: url(' . base_url('assets/images/event.jpg') . ');"></div>
						<div class="text pl-md-5">
							<h2 class="mb-3"><a href="#">No Upcoming Events</a></h2>
							<div class="meta">
								<p>
									<span><i class="icon-calendar mr-2"></i> ' . date('Y m d h:i:s') . ' - ' . date('Y m d h:i:s', strtotime("+1 day")) . ' </span>
									<span><i class="icon-my_location mr-2"></i> <a href="#">Windhoek Central SDA Church</a></span>
									<span><i class="icon-location_city mr-2"></i> Communications Department</span>
								</p>
							</div>
							<p><a href="#" class="btn btn-primary">Read more</a></p>
						</div>
					</div>';
		}

		echo $v;
	}
	function get_sermons($title, $dontGetSlug)
	{
		$v = '';
		$this->db->limit(2);
		$this->db->select("*, posts.body AS 'story'");
		$this->db->join('categories', 'posts.category_id = categories.cat_id', 'left');
		$this->db->order_by('posts.date', 'DESC');
		$query = $this->db->get_where('posts', array(
			'categories.comp_id' => COMPANY_ID,
			'posts.comp_id' => COMPANY_ID,
			'posts.slug !=' => $dontGetSlug,
			'cat_name' => 'Sermons',
			'starting_date' < date('Y-m-d h:i:s'),
			'status' => 'active',
		));

		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<a title="' . $title . ' - ' . $row->title . ' - Sermon' . '" href="' . base_url('post/' . $row->slug) . '" class="sermon-wrap sermon-wrap-2 d-flex align-items-start py-3 ftco-animate">
							<div class="icon">
								<span class="icon-play" title="' . $title . ' - ' . $row->title . ' - Sermon' . '"></span>
							</div>
							<div class="desc">
								<h3 title="' . $title . ' - ' . $row->title . ' - Sermon' . '">' . $row->title . '</h3>
								<span class="time" title="' . $title . ' - ' . $row->title . ' - Sermon' . '">' . $row->date . '</span>
							</div>
						</a>';
			}
		}
		echo $v;
	}
	public function get_posts($cat, $tag)
	{
		$this->db->select("*, posts.body AS 'story'");
		$this->db->join('images', 'post_id = main_id', 'left');
		$this->db->join('categories', 'category_id = cat_id', 'right');
		$this->db->order_by('posts.date', 'ASC');
		if (is_numeric($cat)) {
			$this->db->where('category_id', $cat);
		}
		if ($cat == 'tag') {
			$this->db->like('metaTag', $tag);
		}

		$query = $this->db->get_where(
			'posts',
			array(
				'posts.comp_id' => COMPANY_ID,
				'images.comp_id' => COMPANY_ID,
				'status' => 'active',
				'page' => 'post'
			)
		);

		return $query->result_array();
	}
	function build_captcha()
	{
		$this->load->library('recaptcha');
		echo $this->recaptcha->recaptcha_get_html($error = null, TRUE);
	}
	function month($translate)
	{
		$v = 'No Month';
		if ($translate == '01') {
			$v = 'January';
		}
		if ($translate == '02') {
			$v = 'February';
		}
		if ($translate == '03') {
			$v = 'March';
		}
		if ($translate == '04') {
			$v = 'April';
		}
		if ($translate == '05') {
			$v = 'May';
		}
		if ($translate == '06') {
			$v = 'June';
		}
		if ($translate == '07') {
			$v = 'July';
		}
		if ($translate == '08') {
			$v = 'August';
		}
		if ($translate == '09') {
			$v = 'September';
		}
		if ($translate == '10') {
			$v = 'October';
		}
		if ($translate == '11') {
			$v = 'November';
		}
		if ($translate == '12') {
			$v = 'December';
		}
		return $v;
	}
	public function get_comments($post_id)
	{
		$query = $this->db->get_where(
			'comments',
			array(
				'comp_id' => COMPANY_ID,
				'status' => 3,
				'post_id' => $post_id
			)
		);
		return $query->result_array();
	}
	function add_comment($code)
	{
		$data = array(
			'comp_id' => COMPANY_ID,
			'body' => $this->input->post('message'),
			'post_id' => $this->input->post('post_id'),
			'username' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'verification_code' => $code,
			'status' => 1,
		);

		if ($this->db->insert('comments', $data)) {
			return array(
				'status' => true,
				'message' => 'Comment was added please check your mail to verify your comment!'
			);
		} else {
			return array(
				'status' => false,
				'message' => 'Failed to add comment, please try again!'
			);
		}
	}
	function send_comment_mail($code)
	{

		$this->email->from('no-reply@wccsda.com', 'WCC Website Comment Bot');
		$this->email->to($this->input->post('email'));
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');

		$this->email->subject('Website Comment Verificaiton');
		$this->email->message('Please Verify your comment by clicking here: ' . base_url('verify/' . $code));

		$this->email->send();
	}
	function verify_comment($code)
	{
		$this->db->limit(1);
		$query = $this->db->get_where(
			'comments',
			array(
				'verification_code' => $code,
				'status' => 1,
				'comp_id' => COMPANY_ID,
			)
		);
		$comment = $query->row_array();

		if ($comment) {
			$data = array(
				'status' => 2,
				'verification_code' => '',
			);

			$this->db->where('comment_id', $comment['comment_id']);
			if ($this->db->update('comments', $data)) {
				return true;
			}
		}
	}





	public function portfolio_cats()
	{
		$query = $this->db->get_where('categories', array('comp_id' => COMPANY_ID, 'type' => 'portfolio'));
		$v = '';
		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '<li data-filter=".filter-' . $row->cat_id . '">' . $row->cat_name . '</li> ';
			}
		}

		echo $v;
	}
	public function get_portfolio()
	{
		$this->db->join('images', 'port_id = main_id', 'left');
		$this->db->join('categories', 'category = cat_id', 'right');
		$query = $this->db->get_where('portfolio', array('portfolio.comp_id' => COMPANY_ID, 'images.comp_id' => COMPANY_ID, 'status' => 'active', 'page' => 'portfolio', 'type' => 'portfolio'));
		$v = '';
		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<div class="col-lg-4 col-md-6 portfolio-item filter-' . $row->cat_id . '">
							<div class="portfolio-wrap">
								<img src="' . CMS . 'assets/images/' . $row->file . '" class="img-fluid" alt="">
								<div class="portfolio-info">
									<h4>' . $row->title . '</h4>
									<p>' . $row->client . '</p>
									<div class="portfolio-links">
										<a href="' . CMS . 'assets/images/' . $row->file . '" data-gall="portfolioGallery" class="venobox" title="' . $row->title . '"><i class="bx bx-plus"></i></a>
										<a href="' . $row->link . '" title="More Details"><i class="bx bx-link"></i></a>
									</div>
								</div>
							</div>
						</div>';
			}
		} else {
			$v = '1No Partners Listed!';
		}

		echo $v;
	}
	public function get_team()
	{
		$this->db->select('*');
		$this->db->from('team t');
		$this->db->join('images i', 't.team_id = i.main_id', 'left');
		$this->db->where(array('t.comp_id' => COMPANY_ID, 'i.comp_id' => COMPANY_ID, 'i.page' => 'team'));
		$query = $this->db->get();

		$v = '';

		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<div class="col-md-3 col-sm-4 wow fadeIn" data-wow-delay="0.3s">
            			    <img src="' . CMS . 'assets/images/' . $row->file . '" class="img-responsive" alt="team img">
            			    <h4>' . $row->name . '</h4>
            			    <h3>' . $row->position . '</h3>
            			    <p>' . $row->brief . '</p>
            			    <ul class="social-icon text-center">';
				if ($row->facebook != '') {
					$v .= '<li><a href="' . $row->facebook . '" class="wow fadeInUp fa fa-facebook" data-wow-delay="2s"></a></li><a href="">';
				}
				if ($row->twitter != '') {
					$v .= '<li><a href="' . $row->twitter . '" class="wow fadeInDown fa fa-twitter" data-wow-delay="2s"></a></li><a href="">';
				}
				if ($row->instagram != '') {
					$v .= '<li><a href="' . $row->instagram . '" class="wow fadeIn fa fa-instagram" data-wow-delay="2s"></a></li><a href="">';
				}
				if ($row->linkedin != '') {
					$v .= '<li><a href="' . $row->linkedin . '" class="wow fadeInUp fa fa-linkedin" data-wow-delay="2s"></a></li><a href="">';
				}




				$v .= '</ul>
            		</div>';
			}
		} else {
			$v = 'There are no team members!';
		}

		echo $v;
	}
	public function get_faq()
	{
		$this->db->order_by('arrangement', 'ASC');
		$query = $this->db->get_where('faqs', array('comp_id' => COMPANY_ID, 'status' => 'active'));
		$v = '';
		$i = 1;
		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '	<li>
							<a data-toggle="collapse" class="collapsed" href="#faq' . $i . '">' . $row->question . '<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
							<div id="faq' . $i . '" class="collapse" data-parent=".faq-list">
								<p>
								' . $row->answer . '
								</p>
							</div>
						</li>';
				$i++;
			}
		} else {
			$v = '	<li>
				<a data-toggle="collapse" class="collapsed" href="#faq1">There are no FAQs<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
			</li>';
		}

		echo $v;
	}
	function get_page($slug)
	{

		$this->db->join('images', 'page_id = main_id', 'left');
		return $this->db->get_where('pages', array(
			'pages.comp_id' => COMPANY_ID,
			'images.comp_id' => COMPANY_ID,
			'slug' => $slug,
			'page' => 'page'
		))->row_array();
	}
	function get_pages()
	{
		$this->db->where('comp_id', COMPANY_ID);
		$this->db->order_by('arrangement', 'ASC');
		$query = $this->db->get('pages');
		return $query->result_array();
	}
	public function social_media()
	{
		$query = $this->db->get_where('social_media', array('comp_id' => COMPANY_ID));
		$v = '';
		if ($query->result()) {
			foreach ($query->result() as $row) {
				$v .= '<a href="' . $row->link . '" class="twitter"><i class="' . $row->icon . '"></i></a>';
			}
		}

		echo $v;
	}
	public function get_menu()
	{
		$query = $this->db->get_where('pages', array('comp_id' => COMPANY_ID, 'status' => 'active'));
		$v = '';
		$i = 1;
		if ($query->result()) {
			$v .= '<ul>';
			foreach ($query->result() as $row) {
				if ($i == 1) {
					$v .= '<li class="active"><a href="#hero">Home</a></li>';
				} else {
					$v .= '<li><a href="#' . $row->slug . '">' . $row->title . '</a></li>';
				}
				$i++;
			}
			$v .= '</ul>';
		} else {
			$v = 'There is no menu!';
		}

		echo $v;
	}

	public function get_contact_details()
	{
		$query = $this->db->get_where('contact_details', array('comp_id' => COMPANY_ID));
		return $query->row();
	}
}
