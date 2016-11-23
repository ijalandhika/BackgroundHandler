# BackgroundHandler

# 
#	Installation
#

1. Clone this repositories
2. copy .env.dist to .env 
3. composer install 
4. add your task for any process


#
#	Rules
#

1. for any task will be in 'tasks' folder
2. any process to databases will be in 'models' folder
3. for process generals will be in 'libraries' folder

#
# Generate Access Token Instagram
#

1. oauth code 
	--> params {
		1. client_id
		2. scope
		3. redirect_url
	}
	ex : https://api.instagram.com/oauth/authorize/?client_id=446a32d5969e432a898452d9a98c8799&scope=public_content&redirect_uri=https://ijalandhika.wordpress.com&response_type=code

	will redirect with response code 

	https://ijalandhika.wordpress.com/?code=27cc1418d24441ef9eb1690c35e0a749

2. generate access token
	--> params {
		1. client_id
		2. client_secret
		3. grant_type
		4. redirect_uri
		5. code
	}
	ex :
	curl -F 'client_id=446a32d5969e432a898452d9a98c8799' \
	    -F 'client_secret=c2ad95ab70974196b425c4ba50afd2ad' \
	    -F 'grant_type=authorization_code' \
	    -F 'redirect_uri=https://ijalandhika.wordpress.com' \
	    -F 'code=27cc1418d24441ef9eb1690c35e0a749' \
	    https://api.instagram.com/oauth/access_token

	will generate like below code
	{"access_token": "4027763067.446a32d.bc151f5ff24f4aadaaa4058ffe16b0f2", "user": {"username": "ijalandhika", "bio": "", "website": "", "profile_picture": "https://scontent.cdninstagram.com/t51.2885-19/14553062_323409678019791_3397793445849333760_a.jpg", "full_name": "Syahrizal Andhika", "id": "4027763067"}}