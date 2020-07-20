<?php

class GitHubWidget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
     * https://codex.wordpress.org/Widgets_API
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'GitHubWidget',
			'description' => 'Plugin para listar diretorios do GitHub via API',
		);
		parent::__construct( 'githubwidget', 'Git Hub Widget View', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        // instance now created in form() + update()
        $user_github = $instance['user_github'];
        $qtd_github = $instance['qtd_github'];
        
        $request_user = "https://api.github.com/users/".$user_github;
        $user = $this->rsm_convert_json($request_user);

        $request_url = "https://api.github.com/users/".$user_github."/repos?sort=createdDate&per_page=".$qtd_github;
        $repos = $this->rsm_convert_json($request_url);

        echo '<div class="rsm-usuario">
            <hr>
            <h4>Repositórios:</h4><br>
            <img class="rsm-plg-img" src="'.$user->avatar_url.'" alt="Avatar"><br>
            Nickname: '.$user->login.' <br>
        </div><br>';
       
        $htmlRepos = '<div><ul class="list-rsm-ul">';
        foreach ($repos as $repo) {
            $htmlRepos .= '<li>'.$repo->name. ' - ';
            $htmlRepos .= '<a href="'.$repo->html_url.'" target="_blank">VER</a> </li>';
        }
        $htmlRepos .= '</ul></div>';
        echo $htmlRepos;
        
    }

    public function rsm_convert_json($url){
        $options = ["http"=> array("user_agent" => $_SERVER['HTTP_USER_AGENT'])];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response);
        return $data;
    }

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        // outputs the options form on admin
        $user = $instance['user_github'];
        $qtd = $instance['qtd_github'];
        
        echo '<div><h4>Widget:</h4>
            <label for="user">Usuário: </label><br>
            <input type="text" name="'.$this->get_field_name('user_github').'" id="'.$this->get_field_id('user_github').'" value="'.$user.'"><br>
            <label for="user">Quantidade repositórios: </label><br>
            <input type="text" name="'.$this->get_field_name('qtd_github').'" id="'.$this->get_field_id('qtd_github').'" value="'.$qtd.'"></div>';
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = [];
        $instance['user_github'] = $new_instance['user_github'];
        $instance['qtd_github'] = $new_instance['qtd_github'];
        return $instance;
	}
}