//----------------------Init----------------------------
var FBAppId = "609772232449055";

//var FBAppId = "286953871458218";
//var googleClientId = '1045340234731-1on3vup1igqmncmunj6g3utvg5qermlt.apps.googleusercontent.com';
//var GetUserByProviderAPI = 'http://203.124.121.9/PWGServiceProd/WebService/v2/SocialMediaManager/GetConnectionHttpGet';
//var GetProviderByUserAPI = 'http://203.124.121.9/PWGServiceProd/WebService/v2/SocialMediaManager/GetSocialMediaAttachmentHttpGet';
//var AttachProviderToUserAPI = 'http://203.124.121.9/PWGServiceProd/WebService/v2/SocialMediaManager/AddConnectionHttpGet';
//var RemoveProviderFromUserAPI = 'http://203.124.121.9/PWGServiceProd/WebService/v2/SocialMediaManager/RemoveConnectionHttpGet';
//var TwitterGetRequestTokenAPI = '/Home/GetRequestToken';


/*var APIDomain = 'http://203.124.121.9:888/PWGServiceDev';
var FBAppId = '286953871458218';
var googleClientId = '163955323807-sb57f642jo640bfnkulot2l1hkvv3u0t.apps.googleusercontent.com';
var GetUserByProviderAPI = APIDomain + '/WebService/v2/SocialMediaManager/GetConnectionHttpGet';
var GetProviderByUserAPI = APIDomain + '/WebService/v2/SocialMediaManager/GetSocialMediaAttachmentHttpGet';
var AttachProviderToUserAPI = APIDomain + '/WebService/v2/SocialMediaManager/AddConnectionHttpGet';
var RemoveProviderFromUserAPI = APIDomain + '/WebService/v2/SocialMediaManager/RemoveConnectionHttpGet';
var TwitterGetRequestTokenAPI = '/tool/home/GetRequestToken/'; 
*/


//------------------------------------------------------

//-----------------Google js----------------------------
(function () {
    var po = document.createElement('script');
    po.type = 'text/javascript'; po.async = true;
    po.src = 'https://plus.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
})();
//----------------------------------------------------------

//-----------------Facebook js----------------------------
(function (d) {
    var js, id = 'facebook-jssdk'; if (d.getElementById(id)) { return; }
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    d.getElementsByTagName('head')[0].appendChild(js);
}(document));

window.fbAsyncInit = function () {
    FB.init({
        appId: FBAppId,
        status: true,
        cookie: true,
        xfbml: true,
        oauth: true
    });

    // doFBLogout();
};

//----------------------------------------------------------

var callBackFunc;
var currentProvider;
var responseRedirectPath;
//public functions

function SignInSocialMediaFBAppPage(callBackFunction, provider, redirectPath) {
    callBackFunc = callBackFunction;
    currentProvider = provider.toLowerCase();

    if (redirectPath != undefined) {
        responseRedirectPath = redirectPath.toLowerCase();
    }

    switch (provider.toLowerCase()) {
        case "google":
            var myParams = {
                'clientid': googleClientId,
                'cookiepolicy': 'single_host_origin',
                'callback': 'onSignInCallback',
                'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
                'requestvisibleactions': 'http://schemas.google.com/AddActivity',
                'approvalprompt': 'force'
                // Additional parameters
            };

            gapi.auth.signIn(myParams);
            break;

        case "facebook":
            var oldToken = FB.getAccessToken();
            FB.login(function (response) {
                if (response.authResponse && response.authResponse.accessToken != oldToken) {
                    FB.api('/me', function (response) {
                        // GetUserByProviderId(response);

                        var data = new Object();
                        data.AcknowledgeType = 0;
                        loginviafbapp = 1;
                        CallbackResponse(data, response);
                    });
                } else {
                    // The person cancelled the login dialog
                }
            }, { scope: 'email,user_photos,user_birthday' });
            break;

        case "twitter":
            GetRequestTokenTwitter();
            break;
    }
}

function SignInSocialMedia(callBackFunction, provider, redirectPath) {
    callBackFunc = callBackFunction;
    currentProvider = provider.toLowerCase();

    if (redirectPath != undefined) {
        responseRedirectPath = redirectPath.toLowerCase();
    }

    switch (provider.toLowerCase()) {
        case "google":
            var myParams = {
                'clientid': googleClientId,
                'cookiepolicy': 'single_host_origin',
                'callback': 'onSignInCallback',
                'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
                'requestvisibleactions': 'http://schemas.google.com/AddActivity',
                'approvalprompt': 'force'
                // Additional parameters
            };

            gapi.auth.signIn(myParams);
            break;

        case "facebook":
            var oldToken = FB.getAccessToken();
            FB.login(function (response) {
                if (response.authResponse && response.authResponse.accessToken != oldToken) {

                    FB.api('/me', function (response) {

                        //GetUserByProviderId(response);

                        var data = new Object();
                        data.AcknowledgeType = 0;

                        CallbackResponse(data, response);
                    });

                } else {
                    // The person cancelled the login dialog
                }
            }, { scope: 'email,user_photos,user_birthday', auth_type: 'reauthenticate' });
            break;

        case "twitter":
            GetRequestTokenTwitter();
            break;
    }
}

function RemoveConnectionUser(callBackFunction, userId, provider) {
    callBackFunc = callBackFunction;

    $.ajax({
        url: RemoveProviderFromUserAPI,
        data: { userId: userId, provider: provider },
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
            callBackFunc(data);
        }
    });
}

function AddConnectionUser(callBackFunction, userId, provider, providerId) {
    callBackFunc = callBackFunction;

    $.ajax({
        url: AttachProviderToUserAPI,
        data: { userId: userId, provider: provider, providerId: providerId },
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
            callBackFunc(data);
        }
    });
}

function GetConnectionUser(callBackFunction, providerId) {
    callBackFunc = callBackFunction;

    $.ajax({
        url: GetUserByProviderAPI,
        data: { providerId: providerId },
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
            callBackFunc(data);
        }
    });
}

function GetSocialMediaAttachmentUser(callBackFunction, userId) {
    callBackFunc = callBackFunction;

    $.ajax({
        url: GetProviderByUserAPI,
        data: { userId: userId },
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
            callBackFunc(data);
        }
    });
}

function GetContacts(callBackFunction, provider) {
    callBackFunc = callBackFunction;
    currentProvider = provider.toLowerCase();

    switch (provider.toLowerCase()) {
        case "google":
            var myParams = {
                'clientid': googleClientId,
                'cookiepolicy': 'single_host_origin',
                'callback': 'onGetContactsCallback',
                'scope': 'https://www.google.com/m8/feeds/',
                'approvalprompt': 'force'
                // Additional parameters
            };

            gapi.auth.signIn(myParams);
            break;

        case "facebook":
            break;

        case "twitter":
            break;
    }
}

function GetAlbumsFacebook(callBackFunction) {
    callBackFunc = callBackFunction;

    var oldToken = FB.getAccessToken();
    FB.login(function (response) {
        if (response.authResponse && response.authResponse.accessToken != oldToken) {
            GetFacebookAlbums(response);
        } else {
            // The person cancelled the login dialog
        }
    }, { scope: 'email,user_photos,user_birthday' });
}

function GetPhotosFromAlbum(callBackFunction, albumId) {
    callBackFunc = callBackFunction;
    var facebookPhotos = new Array();

    FB.api('/' + albumId + '/photos', function (photos) {
        if (photos && photos.data && photos.data.length) {
            for (var j = 0; j < photos.data.length; j++) {
                var p = photos.data[j];
                // photo.picture contain the link to picture
                var photo = new Object();
                photo.Id = p.id;
                photo.Name = p.title;
                photo.ImageUrl = p.source;
                photo.ThumbnailURL = p.picture;
                facebookPhotos.push(photo);

                if (j == photos.data.length - 1) {
                    CallbackResponseForPhotosByFBAlbums(facebookPhotos, albumId);
                    break;
                }
            }
        }
		if(photos.data.length==0){
			alert("No picture found.");
		}
    });
}

function GetPhotos(callBackFunction, provider) {
    callBackFunc = callBackFunction;
    currentProvider = provider.toLowerCase();

    switch (provider.toLowerCase()) {
        case "google":

            break;

        case "facebook":
            var oldToken = FB.getAccessToken();
            FB.login(function (response) {
                if (response.authResponse && response.authResponse.accessToken != oldToken) {
                    GetFacebookPhotos(response);
                } else {
                    // The person cancelled the login dialog
                }
            }, { scope: 'email,user_photos,user_birthday', auth_type: 'reauthenticate,https' });
            break;

        case "twitter":
            break;
    }
}

function OpenFBShareWindow(_url) {
    var url = encodeURIComponent(_url); //url to share
    var d = new Date();

    var FBShareUrl = 'http://www.facebook.com/sharer.php?u=' + url + '&d=' + d.getTime();
    window.open(FBShareUrl, 'sharer', 'left=400,width=600,height=450,scrollbars=1,status=0,toolbar=0,menubar=0');
}

function OpenTweetWindow(_title, _url) {
    var d = new Date();
    var url = encodeURIComponent(_url);
    var TweetUrl = 'http://twitter.com/share?count=horizontal' + '&text=' + _title + '&url=' + url + '&d=' + d.getTime();
    window.open(TweetUrl, '', 'left=400,width=600,height=450,scrollbars=1,status=0,toolbar=0,menubar=0');
}

function OpenGoogleShareWindow(_url) {
    var url = encodeURIComponent(_url); //url to share
    var d = new Date();

    var GoogleShareUrl = 'https://plus.google.com/share?url=' + url + '&d=' + d.getTime();
    window.open(GoogleShareUrl, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
}

function InviteYourFriends(callBackFunction) {
    callBackFunc = callBackFunction;

    var oldToken = FB.getAccessToken();
    FB.login(function (response) {
        if (response.authResponse && response.authResponse.accessToken != oldToken) {
            FB.api('/me/friends', function (response) {
                var obj = response;

                if (response.data.length > 0) {
                    var toFriends = "";

                    var len;
                    if (response.data.length > 50)
                        len = 50;
                    else
                        len = response.data.length;


                    for (var i = 0; i < len; i++) {
                        toFriends = toFriends + response.data[i].id + ",";
                    }

                    toFriends = toFriends.substring(0, toFriends.lastIndexOf(','));

                    FB.ui({
                        method: 'apprequests',
                        message: 'My Great Request',
                        to: toFriends
                    }, requestCallback);
                }
                else {
                    alert("There is no friend in your account.");
                }

            });
        } else {
            // The person cancelled the login dialog
        }
    }, { scope: 'email,user_photos' });
}

function requestCallback(response) {
    callBackFunc(response);
}

//Private Functions
function onSignInCallback(authResult) {
    helper.onSignInCallback(authResult);
}

function onGetContactsCallback(authResult) {
    helper.Contacts(authResult);
}

var helper = (function () {
    return {
        onSignInCallback: function (authResult) {
            gapi.client.load('plus', 'v1', function () {
                if (authResult['access_token']) {
                    var request = gapi.client.plus.people.get({ 'userId': 'me' });
                    request.execute(function (profile) {
                        //GetUserByProviderId(profile);
                        var data = new Object();
                        data.AcknowledgeType = 0;

                        CallbackResponse(data, profile);
                    });
                } else if (authResult['error']) {

                }
            });
        },
        people: function (authResult) {
            gapi.client.load('plus', 'v1', function () {
                if (authResult['access_token']) {
                    var request = gapi.client.plus.people.list({
                        'userId': 'me',
                        'collection': 'visible'
                    });
                    request.execute(function (people) {
                        var aa = people;
                    });
                } else if (authResult['error']) {

                }
            });
        },
        Profile: function (authResult) {
            gapi.client.load('plus', 'v1', function () {
                if (authResult['access_token']) {
                    var request = gapi.client.plus.people.get({ 'userId': 'me' });
                    request.execute(function (profile) {
                        var aa = profile;
                    });
                } else if (authResult['error']) {

                }
            });
        },
        Contacts: function (authResult) {
            if (authResult['access_token']) {
                var feedUrl = '/tool/home/GetGoogleContacts/';
                $.ajax({
                    url: feedUrl.toLowerCase(),
                    data: { accessToken: authResult['access_token'] },
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        callBackFunc(data);
                    }
                });
            } else if (authResult['error']) {

            }
        }
    };
})();

function GetUserByProviderId(profile) {
    $.ajax({
        url: GetUserByProviderAPI,
        data: { providerId: profile.id },
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
            CallbackResponse(data, profile);
        }
    });
}

function GetRequestTokenTwitter() {
    $.ajax({
        url: TwitterGetRequestTokenAPI.toLowerCase(),
        data: {},
        type: "POST",
        success: function (data) {
            if (data.response.AcknowledgeType == 1) {
                if (data.response.TokenResponse != null) {
                    OpenTwitterLogin(data.response);
                }
                else {
                    alert("Twitter is not responding right now. Please try again later.");
                }
            } else {
                alert(data.response.Message);
            }
        }
    });
}

function OpenTwitterLogin(response) {
    var target = "https://api.twitter.com/oauth/authenticate?oauth_token=" + response.TokenResponse.Token;
    window.open(target, '_self');
}

function ParseTwitterResponse(callBackFunction, response) {
    if (response.Result == 0) {
        currentProvider = "twitter";
        callBackFunc = callBackFunction;

        GetUserByProviderId(response.ResponseObject);
    }
}

function doFBLogout() {
    FB.logout(function (response) {
        // Person is now logged out
        //alert(response);
    });
}

function GetResponseObject() {
    var response = new Object();
    response.Firstname = "";
    response.Lastname = "";
    response.Email = "";
    response.Gender = "";
    response.ProviderId = "";
    response.ProfileURL = "";
    response.ImageURL = "";
    response.UserId = "";
    response.Provider = "";
    response.Photos = "";
    response.Albums = "";

    return response;
}

function SetFBProfile(profile) {
    var response = GetResponseObject();
    response.Firstname = (profile.first_name != undefined) ? profile.first_name : "";
    response.Lastname = (profile.last_name != undefined) ? profile.last_name : "";
    response.Email = (profile.email != undefined) ? profile.email : "";
    response.Gender = (profile.gender != undefined) ? profile.gender : "";
  //response.Birthday = (profile.birthday != undefined) ? profile.birthday : "";
    response.Birthday = (profile.birthday != undefined) ? convertDate(profile.birthday) : "";
    response.ProviderId = (profile.id != undefined) ? profile.id : "";
    response.ProfileURL = (profile.link != undefined) ? profile.link : "";
    response.ImageURL = 'http://graph.facebook.com/' + response.ProviderId + '/picture?height=500&type=normal&width=500'
    return response;
}

function SetGoogleProfile(profile) {
    var response = GetResponseObject();
    response.Firstname = (profile.name != undefined) ? profile.name.givenName : "";
    response.Lastname = (profile.name != undefined) ? profile.name.familyName : "";
    response.Email = (profile.emails != undefined) ? profile.emails[0].value : "";
    response.Gender = (profile.gender != undefined) ? profile.gender : "";
  //response.Birthday = (profile.birthday != undefined) ? profile.birthday : "";
    response.Birthday = (profile.birthday != undefined) ? convertDate(profile.birthday) : "";
    response.ProviderId = (profile.id != undefined) ? profile.id : "";
    response.ProfileURL = (profile.url != undefined) ? profile.url : "";
    response.ImageURL = (profile.image != undefined) ? profile.image.url : "";
    return response;
}

function SetTwitterProfile(profile) {
    var response = GetResponseObject();
    response.Firstname = (profile.Name != undefined) ? profile.Name.split(' ')[0] : "";
    response.Lastname = (profile.Name != undefined) ? profile.Name.split(' ')[1] : "";
    response.Email = (profile.email != undefined) ? profile.email[0] : "";
    response.Gender = (profile.gender != undefined) ? profile.gender : "";
    response.ProviderId = (profile.Id != undefined) ? profile.Id : "";
    response.ProfileURL = (profile.url != undefined) ? profile.url : "";
    response.ImageURL = (profile.ProfileImageLocation != undefined) ? profile.ProfileImageLocation : "";
    return response;
}

function GetFacebookPhotos(response) {
    var pageAccessToken = response.authResponse.accessToken;
    var uId = response.authResponse.userID;
    var profile;
    var facebookPhotos = new Array();
    var count = 0;
    var albumCount;

    FB.api('/me', function (response) {
        profile = response;
    });

    FB.api('/me/albums?fields=id,name,cover_photo', { access_token: pageAccessToken }, function (response) {
        for (var i = 0; i < response.data.length; i++) {
            var album = response.data[i];
            //var coverPhoto = album.CoverPhoto;
            albumCount = response.data.length;

            FB.api('/' + album.id + '/photos', function (photos) {
                if (photos && photos.data && photos.data.length) {
                    count++;
                    for (var j = 0; j < photos.data.length; j++) {
                        var p = photos.data[j];
                        // photo.picture contain the link to picture
                        var photo = new Object();
                        photo.Id = p.id;
                        photo.Name = p.title;
                        photo.ImageUrl = p.source;
                        photo.ThumbnailURL = p.picture;
                        facebookPhotos.push(photo);

                        if (albumCount == count && j == photos.data.length - 1) {
                            CallbackResponseForPhotos(facebookPhotos, profile);
                            break;
                        }
                    }
                }
            });
        }
    });
}

function GetFacebookAlbums(response) {
    var pageAccessToken = response.authResponse.accessToken;
    var uId = response.authResponse.userID;
    var profile;
    var facebookAlbums = new Array();
    var ct = 0;
    var albumCount;

    FB.api('/me', function (response) {
        profile = response;
    });

    FB.api('/me/albums?fields=id,name,count,cover_photo', { access_token: pageAccessToken }, function (response) {

		if(response.data.length==0){
			alert("No picture found.");
			disablePopup('pageLoader');
		}

        for (var i = 0; i < response.data.length; i++) {
            var a = response.data[i];
            albumCount = response.data.length;
            var resp = response;

            FB.api('/' + a.cover_photo, function (response1) {
                ct++;
                var album = new Object();
                album.Id = resp.data[ct - 1].id;
                album.Name = resp.data[ct - 1].name;
                album.CoverImage = response1.source;
                album.Count = resp.data[ct - 1].count;
                facebookAlbums.push(album);

                if (albumCount == ct) {
                    CallbackResponseForFBAlbums(facebookAlbums, profile);
                }
            });
        }
    });
}

function GetGoogleContacts(response) {

}

function CallbackResponse(data, profile) {
    var response;

    switch (currentProvider) {
        case "google":
            response = SetGoogleProfile(profile);
            break;

        case "facebook":
            response = SetFBProfile(profile);
            //doFBLogout();
            break;

        case "twitter":
            response = SetTwitterProfile(profile);
            break;
    }

    response.Provider = currentProvider;

    if (data.AcknowledgeType == 1) {
        response.UserId = data.SocialMediaConnection.UserID;
        response.Provider = data.SocialMediaConnection.Provider;
    }

    callBackFunc(response);
}

function CallbackResponseForPhotos(data, profile) {
    var response = new Object();

    switch (currentProvider) {
        case "google":

            break;

        case "facebook":
            response = SetFBProfile(profile);
            response.Photos = data;
            //doFBLogout();
            break;

        case "twitter":

            break;
    }

    response.Provider = currentProvider;

    callBackFunc(response);
}

function CallbackResponseForFBAlbums(data, profile) {
    var response = new Object();

    response = SetFBProfile(profile);
    response.Albums = data;
    response.Provider = "facebook";

    callBackFunc(response);
}

function CallbackResponseForFBAlbums(data, profile) {
    var response = new Object();

    response = SetFBProfile(profile);
    response.Albums = data;
    response.Provider = "facebook";

    callBackFunc(response);
}

function CallbackResponseForPhotosByFBAlbums(data, albumId) {
    var response = new Object();

    response.PhotosByAlbum = data;
    response.AlbumId = albumId;

    callBackFunc(response);
}
function convertDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(inputFormat);
    return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/');
}