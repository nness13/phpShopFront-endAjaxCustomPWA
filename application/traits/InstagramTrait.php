<?php

namespace application\traits;

require 'vendor/autoload.php';


trait InstagramTrait {

    public function randomingInt(){
        return random_int(2500000,3000000);
    }

    public function editinstaTaskManager($id, $list, $unlist = null, $status = ['status'=> 1, 'cron_status' => 0]) {
        $where = 'id';
        $last = 'status';
        $params = [
            'id' => $id,
            'list' => $list,
            'unlist' => $unlist,
            'cron_status' => $status['cron_status'],
            'status' => $status['status']
        ];
        $valkeys = '';
        foreach ($params as $key => $value) {
            if ($key != $where) {
                if ($key == $last) {
                    $valkeys .= "$key= :$key";
                }else {
                    $valkeys .= "$key= :$key, ";
                }
            }
        }
        $this->db->query("UPDATE InstaTaskManager SET $valkeys WHERE $where = :$where", $params, $params);
    }

		public function instaLogin($instalogin, $instapassword, $for = null, $post = null) {
			\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
			$this->ig = new \InstagramAPI\Instagram(false, false);
			try {
//                  $proxy = '37.54.68.232:2020';
                $proxy = 'proxyu:Zx12cv13bn19@ihost.hopto.org:2020';
                $this->ig->setProxy(['socks5' => 'socks5://'.$proxy]);
                    if($for == 'two_factor') {
                        if (isset($_SESSION['instagram']['two_factor'])) {
                            try{
                                $this->ig->finishTwoFactorLogin($instalogin, $instapassword, $_SESSION['instagram']['two_factor']['two_factor_identifier'], $post);
                            }catch (\Exception $e){
                                return false;
                            }
                            $response = $this->instaLogin($_SESSION['instagram']['two_factor']['logname'], $_SESSION['instagram']['two_factor']['code'], 'auth');
                            $_POST['profile_pic_url'] = $response['info']['user']['profile_pic_url'];
                            $_POST['proxy'] = $response['proxy'];
                            $_POST['instalogin'] = $_SESSION['instagram']['two_factor']['logname'];
                            $_POST['instapassword'] = $_SESSION['instagram']['two_factor']['code'];
                            $this->instaUserAdd($_POST);
                            unset($_SESSION['instagram']['two_factor']);
                            return true;
                        }
                    }
                $loginResponse = $this->ig->login($instalogin, $instapassword);
                    if($for == 'auth'){
                        if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
                                $twoFactor = $loginResponse->getTwoFactorInfo()->asArray();
                                $_SESSION['instagram']['two_factor'] = $twoFactor;
                                $_SESSION['instagram']['two_factor']['proxy'] = $proxy;
                                $_SESSION['instagram']['two_factor']['logname'] = $instalogin;
                                $_SESSION['instagram']['two_factor']['code'] = $instapassword;
                                return 'two_factor';
                        }
                        $user = $this->ig->account->getCurrentUser();
                        $user = $user->asArray();
                        return ['info' => $user, 'proxy' => $proxy];
                    }
            } catch (\Exception $e) {
                $a = $e->getResponse();
                    if($a != NULL){
                        if($for == 'auth') {
                            if ($a->asArray()['message'] == 'challenge_required') {
                                $a = $a->asArray();
                                $path = ltrim($a['challenge']['api_path'], "/");
                                $d = $this->getDetails($path);

                                $_SESSION['instagram']['challenge'] = $d;
                                $_SESSION['instagram']['challenge']['path'] = $path;
                                $_SESSION['instagram']['challenge']['proxy'] = $proxy;
                                $_SESSION['instagram']['challenge']['logname'] = $instalogin;
                                $_SESSION['instagram']['challenge']['code'] = $instapassword;
                                $_SESSION['instagram']['challenge']['status'] = 0;

                                return 'challenge';
                            } else {
                                return false;
                            }
                        }elseif($for == 'challengeSend'){
                            if($a->asArray()['message'] == 'challenge_required'){
                                $this->sendCode($_SESSION['instagram']['challenge']['path'], $post);
                                $_SESSION['instagram']['challenge']['status'] = 1;
                                return true;
                            }else{
                                return false;
                            }
                        }elseif($for == 'challengeComplete'){
                            if($a->asArray()['message'] == 'challenge_required'){
                                $this->completeCode($_SESSION['instagram']['challenge']['path'], $post);
                                $response = $this->instaLogin($_SESSION['instagram']['challenge']['logname'], $_SESSION['instagram']['challenge']['code'], 'auth');
                                if($response == 'challenge'){
                                    return 'illegalChallenge';
                                }
                                $_POST['profile_pic_url'] = $response['info']['user']['profile_pic_url'];
                                $_POST['proxy'] = $response['proxy'];
                                $_POST['instalogin'] = $_SESSION['instagram']['challenge']['logname'];
                                $_POST['instapassword'] = $_SESSION['instagram']['challenge']['code'];
                                $this->instaUserAdd($_POST);
                                unset($_SESSION['instagram']['challenge']);
                                return true;
                            }else{
                                return false;
                            }
                    }
				}
		
		
			}

			return $this->ig;
		}

		public function getDetails($path){
			$path = $path.'?guid='.$this->ig->uuid.'&device_id='.$this->ig->device_id;
			return $this->ig->request($path)
				->setNeedsAuth(false)
				->getDecodedResponse(true);
		}
	
		public function sendCode($path, $challenge){
			return $this->ig->request($path)
				->setNeedsAuth(false)
				->addPost('choice', $challenge)
				->addPost('_csrftoken', $this->ig->client->getToken())
				->addPost('quid', $this->ig->uuid)
				->addPost('device_id', $this->ig->device_id)->getDecodedResponse(true);
		}

		public function completeCode($path, $code){
			return $this->ig->request($path)
				->setNeedsAuth(false)
				->addPost('security_code', $code)
				->addPost('_csrftoken', $this->ig->client->getToken())
				->addPost('quid', $this->ig->uuid)
				->addPost('device_id', $this->ig->device_id)->getDecodedResponse(true);
				$this->_updateLoginState($response);
            	$this->_sendLoginFlow(true, $appRefreshInterval);
		}
}