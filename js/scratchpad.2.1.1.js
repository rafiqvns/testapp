var currentParams = {}

// Sample callback function
function displayResults(paramHash){
        
    var selectedVersion = $('scratch_version').value * 1;
    // NOTE: The return params are formatted differently between Version 1 & Version 2, 
    // so we'll parse according to which Version is currently selected.
    // In practice you will know which version you're using and thus the return format
    // so this check would be unnecessary.
    if(selectedVersion == 1){
        displayVersion1Results(paramHash);
    }else{
        displayVersion2Results(paramHash);  
    }
}

function displayVersion1Results(paramHash)
{
    var output='<h4>File Details</h4><pre class="output">';
    var thumbnailData = paramHash.thumbnailDataURL;
    if(thumbnailData){
        output+='<div class="thumb_preview"><img src="'+picupUnescape(thumbnailData)+'"/></div>';
    }
    output += '<div class="json">'+$H(paramHash).toJSON().replace(/\"\,/gmi, '",\n')+'</div>';
    output += '</pre>';
	$('output').innerHTML = output;
	window.scrollTo(0,10000);
}

function displayVersion2Results(paramHash)
{
    var fileDict = {}
    var numFiles = 0;
    for(var keyName in paramHash){
        // file[i][paramName]
        try{
            var fileIndex = keyName.match(/file\[(\d+)\]/)[1];
            var paramName = keyName.match(/file\[\d+\]\[([^\]]+)\]/)[1];            
            
            var file = fileDict[fileIndex];
            if(!file){
                file = {};
                fileDict[fileIndex] = file;
                numFiles++;
            }
            file[paramName] = paramHash[keyName];
            
        }catch(err){
            console.log("ERROR: Couldn't parse the param key "+keyName);
        }
    }
    var output="";
    for(var i=0;i<numFiles;i++){
        var file = fileDict[i+""];
        output+='<h4>File '+i+'</h4>';
        output+='<div><a href="'+Picup2.urlForOptions('view', {'picID' : file.picID})+'">View in Picup</a></div>';
        output+='<pre class="output">';
        var thumbnailData = file.thumbnailDataURL;
        if(thumbnailData){
            output+='<div class="thumb_preview"><img src="'+picupUnescape(thumbnailData)+'"/></div>';
        }
        output+= '<div class="json">'+$H(file).toJSON().replace(/\"\,/gmi, '",\n')+'</div>';
        output+='</pre>';
    }
    $('output').innerHTML = output;

    var isIPad = navigator.userAgent.indexOf('iPad') != -1;
    var isIPhone = navigator.userAgent.indexOf('iPhone') != -1;

    if(isIPhone && !isIPad){
        $('file_input_caption').innerHTML = "<p><strong>IMPORTANT:</strong> Close the callback window before making another selection.</p>";
    }else{
        $('file_input_caption').innerHTML = "";
    }

	window.scrollTo(0,$('output').positionedOffset().top);
}		

function isVisibleForAction(e)
{
    return e.getAttribute('data-action') == $('scratch_action').value;
}

function isVisibleForVersion(e)
{
    var selectedVersion = $('scratch_version').value * 1;
    var paramMinVersion = e.getAttribute('data-minversion') * 1;
    var paramMaxVersion = e.getAttribute('data-maxversion') * 1;
    return (paramMinVersion <= selectedVersion && paramMaxVersion >= selectedVersion);    
}

function paramElementIsVisible(e){
    var isVisible = isVisibleForAction(e);
    isVisible = isVisible && isVisibleForVersion(e);
    return isVisible;
}

function updateParamsForNewSettings(){
    
    var selectedVersion = $('scratch_version').value * 1;
    
    if(selectedVersion < 2){
        Picup2.customURLScheme = 'fileupload://';         
    }else{
        Picup2.customURLScheme = 'fileupload2://'; 
        // Set the min-version-required value
        $('minRequiredVersion_value').value = selectedVersion;
    }
    
    currentParams = {};
    
    $$('#sample_params li.sample_param').each(function(e,i){
        
        var isVisible = paramElementIsVisible(e);
        
		// If this param is not applicable, clear it out.
		// Otherwise, keep it for the current version
		var inputEl = e.select('input')[0];
		if(isVisible){ 
		    if(inputEl.value && !!inputEl.value.trim()){
		        currentParams[e.id] = inputEl.value;
	        }
	    }else{
	        inputEl.value = '';
	    }
	    
	    e.style.display = isVisible ? 'block' : 'none';
    	
        
	});
	
	if(Picup2.isMobileIOS()){
	    if($('scratch_action').value == 'new'){
	        $('file_upload_input').show();
	        $('file_view_input').hide();
	    }else{
	        $('file_upload_input').hide();
	        $('file_view_input').show();	        
        }
	}	
		
	updateScratchWithCurrentParams();

}

function toggleOptionInfoFor(paramName){
	$(paramName+'_description').toggle();
	$(paramName).toggleClassName('selected');
}

function updateScratchWithCurrentParams(){

	// Update the variable inputs	
	for(var paramName in currentParams){
		$(paramName+'_value').value = currentParams[paramName];
	}
	
	// Update the URL
	$('scratch_url').innerHTML = Picup2.urlForOptions($('scratch_action').value, currentParams);
	
	// Show which params are selected
	$$('#sample_params li.sample_param').each(function(e,i){
		var isVisible = !!currentParams[e.id];
		// Clear out the value if it's not being used
		var inputEl = e.select('input')[0];
		if(!isVisible) inputEl.value = '';
	});			
	
	// Each time the params change, we'll convert the input field.
	// In practice, this will probably be called once, on page load
	if(Picup2.isMobileIOS()){
	    Picup2.convertFileInput($('file_upload_input'), currentParams);	
	}	
}

function viewScratchURL(){
    Picup2.openFileWithId(currentParams.picID);
}

function showAllOptions(){
    $$('.sample_param').each(function(el){
        if(paramElementIsVisible(el)){
            $(el.id+'_description').show();
        	el.addClassName('selected');    	        
    	}
    });
}

function hideAllOptions(){
    // Hide the descriptions
    $$('.sample_param').each(function(el){
        $(el.id+'_description').hide();
    	el.removeClassName('selected');    	        
    });
}

function picupUnescape(v)
{
    if(decodeURI){
        return decodeURI(v);
    }
    return unescape(v);
}

function picupEscape(v)
{
    if(encodeURI){
        return encodeURI(v);
    }
    return escape(v);
}

function escapeValue(value, paramName){
    // NOTE:
    // We want to make sure we don't escape already escaped values
    var components = value.split('%');
    var escapedComponents = [];
    for(var i=0;i<components.length;i++){
        var token = components[i];
        if(token.indexOf("://") == -1 &&
           token.indexOf("=") == -1 &&
           token.indexOf("&") == -1 ){
            escapedComponents.push(picupEscape(token));    
        }else{  // This has URI components. Fully escape
            escapedComponents.push(escape(token));
        }
    }
    return escapedComponents.join("%");
}

document.observe('dom:loaded', function(){
    
    isMobile = Picup2.isMobileIOS();
    
	if(isMobile){
		$(document.body).addClassName('iphone');
	}
	
	// Define the callback handler
	Picup2.callbackHandler = displayResults;
	
	// We'll check the hash when the page loads in-case it was opened in a new page
	// due to memory constraints
	Picup2.checkHash();
	
	// Hide the descriptions
	hideAllOptions();

	// Observe text inputs
	$$('#params_selector input[type="text"]').each(function(input, i){
		input.observe('change', function(e){					
			var input = e.element();			
			var paramName = input.id.replace('_value', '');
			var paramValue = input.value.strip();		
			
			// Automatically escape values for the user
			paramValue = escapeValue(paramValue, paramName);    		    
    		
    		input.value = paramValue;
				
			if(!paramValue){
				delete currentParams[paramName];
			}else{	
				currentParams[paramName] = paramValue;
			}
			updateScratchWithCurrentParams();
		});
	});

	updateParamsForNewSettings();

    // Set some starter params	
    currentParams = {
    	'callbackURL' 		: escape('http://picupapp.com/done.html'),
    	'referrerName' 		: picupEscape('Picup Scratchpad'),
    	'referrerFavicon' 	: escape('http://picupapp.com/favicon.ico'),
    	'purpose'           : picupEscape('Select a sample image for the Picup Scratchpad tool.'),
    	'debug' 			: 'true',
    	'minRequiredVersion': ($('scratch_version').value * 1.0),
    };
    

	updateScratchWithCurrentParams();
	
});