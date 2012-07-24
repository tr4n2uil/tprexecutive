/**
 *	@project Snowblozm
 *	@desc JavaScript Service Computing Platform Kernel
 *
 *	@class Snowblozm
 *	@desc Provides Registry and Kernel functionalities
 *	
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
 *	@desc Services are generic modules providing resuable stateless functionalities than tranforms blocks
 *
 *	@interface Service {
 *		public function input(){
 *			... returns array of required parameters and object of optional parameters
 *		}
 *		public function run(message, memory){
 *			... uses memory during execution for receiving and returning parameters
 *			... save reference in Registry, if required, instead of returning objects
 *		}
 *		public function output(){
 *			... returns array of parameters to return 
 *		}
 *	}
 *
 *	@format Message {
 *		service : (reference),
 *		... parameters ...
 *	}
 *
 *	@desc Workflows are array of services that use common memory for state management
 *
 *	@format workflow = [{	
 *		service : ...,
 *		( ... params : ... )
 *	}];
 *
 * 	@desc Navigator is compact way of representing messages
 *	@format Navigator root:name=value:name=value
 *
 *	@example #testtab:tabtitle=Krishna:loadurl=test.php
 *
 *	@escapes basic '=' with '~'
 *
 *	@escapes limited for usage in form id
 *	'#' by '_' 
 *	'=' by '.'
 *
 *	@escapes advanced (not implemented yet) using URL encoding
 *	
**/
var Snowblozm = (function(){
	/**
	 *	@var references array
	 *	@desc an array for saving references
	 *	
	 *	references may be accessed through the Registry
	 *
	**/
	var $references = new Array();
	
	/**
	 *	@var navigator roots array
	 *	@desc an array that saves roots to service workflows
	 *
	**/
	var $navigators = new Array();
	
	return {
		/**
		 *	@var Registry object
		 *	@desc manages references and navigator roots
		 *
		**/
		Registry : {
			/**
			 *	@method save
			 *	@desc saves a Reference with index
			 *
			 *	@param index string
			 *	@param reference object or any type
			 *
			**/
			save : function($index, $reference){
				$references[$index] = $reference;
			},
			
			/**
			 *	@method get
			 *	@desc gets the Reference for index
			 *
			 *	@param index string
			 *
			**/
			get : function($index){
				return $references[$index] || false;
			},
			
			/**
			 *	@method remove
			 *	@desc removes a Reference with index
			 *
			 *	@param index string
			 *
			**/
			remove : function($index){
				$references[$index] = 0;
			},
			
			/**
			 *	@method add
			 *	@desc adds a Navigator root 
			 *
			 *	@param root string
			 *	@param workflow object
			 *
			**/
			add : function($root, $workflow){
				$navigators[$root] = $workflow;
			},
			
			/**
			 *	@method load
			 *	@desc loads a Navigator root workflow
			 *
			 *	@param root string
			 *
			 *	@return workflow object
			 *
			**/
			load : function($root){
				if($navigators[$root] || false) 
					return $navigators[$root];
				return false;
			},
			
			/**
			 *	@method removeNavigator
			 *	@desc removes a Navigator root
			 *
			 *	@param root string
			 *
			**/
			removeNavigator : function($root){
				$navigators[$root] = 0;
			}
		},
		
		/**
		 *	@var Kernel object
		 *	
		 *	@desc manages the following tasks
		 *		runs services and workflows when requested
		 *		processes navigators when received and launch workflows
		 *
		**/
		Kernel : {			
			/** 
			 *	@method execute
			 *	@desc executes a workflow with the given definition
			 *
			 *	@param message object Workflow definition
			 *	@param memory object optional default {}
			 *
			**/
			execute : function($workflow, $memory){
				/**
				 *	create a new memory if not passed
				**/
				$memory = $memory || {};
				$memory['valid'] = $memory['valid'] || true;
			
				for(var $i in $workflow){
					var $message = $workflow[$i];
					
					/**
					 *	Check for non strictness
					**/
					var $nonstrict = $message['nonstrict'] || false;
					
					/**
					 *	Continue on invalid state if non-strict
					**/
					if($memory['valid'] !== true && $nonstrict !== true)
						continue;
					
					/**
					 *	run the service with the message and memory
					**/
					$memory = this.run($message, $memory);
				}
				
				return $memory;
			},
			
			/** 
			 *	@method run
			 *	@desc runs a service with the given definition
			 *
			 *	@param message object Service definition
			 *	@param memory object optional default {}
			 *
			**/
			run : function($message, $memory){
				/**
				 *	Read the service instance
				**/
				var $service = $message['service'];
				if($service.run || false){
				} else {
					$service = Snowblozm.Registry.get($message['service']) || false;
					if(!$service){
						window.alert("Invalid Service : " + $message['service']);
					}
				}
				
				/**
				 *	Read the service arguments
				**/
				var $args = $message['args'] || [];
				
				/**
				 *	Copy arguments if necessary
				**/
				for(var $i in $args){
					var $key = $args[$i];
					$message[$key] = $message[$key] || $memory[$key] || false
				}
				
				/**
				 *	Read the service input
				**/
				var $input = $message['input'] || {};
				var $sin = $service.input();
				var $sinreq = $sin['required'] || [];
				var $sinopt = $sin['optional'] || {};
				
				/**
				 *	Copy required input if not exists (return valid false if value not found)
				**/
				for(var $i in $sinreq){
					var $key = $sinreq[$i];
					var $param = $input[$key] || $key;
					$message[$key] = $message[$key] || $memory[$param] || false;
					if($message[$key] === false){
						$memory['valid'] = false;
						if(Snowblozm.debug || false){
							alert("Value not found for " + $key);
						}
						return $memory;
					}
				}
				
				/**
				 *	Copy optional input if not exists
				**/
				for(var $key in $sinopt){
					var $param = $input[$key] || $key;
					$message[$key] = $message[$key] || $memory[$param] || $sinopt[$key];
				}
				
				/**
				 *	Run the service with the message as memory
				**/
				$message = $service.run($message);
				
				/**
				 *	Read the service output and return if not valid
				**/
				var $output = [];
				$memory['valid'] = $message['valid'] || false;
				if($memory['valid']){
					$output = $message['output'] || [];
				}
				else {
					return $memory;
				}
				var $sout = $service.output();
				
				/**
				 *	Copy output
				**/
				for(var $i in $sout){
					var $key = $sout[$i];
					var $param = $output[$key] || $key;
					$memory[$param] = $message[$key] || false;
				}
				
				/**
				 *	Return the memory
				**/
				return $memory;
			},
			
			/**
			 *	@method launch
			 *	@desc processes the navigator received to launch workflows
			 *
			 *	@param navigator string
			 *	@param escaped boolean optional default false
			 *
			**/
			launch : function($navigator, $escaped, $memory){
				
				var $message = {
					navigator : $navigator
				};
				
				/**
				 *	Process escaped navigator
				**/
				if($escaped || false){
					$navigator = $navigator.replace(/_/g, '#');
					$navigator = $navigator.replace(/\./g, '=');
				}
				//$navigator = $navigator.replace(/\+/g, '%20');
				
				switch($navigator.charAt(1)){
					case '/' : 
						/**
						 *	Parse navigator
						**/
						var $parts = $navigator.split('~');
						
						var $path = $parts[0].split('/');
						var $index = $path.shift() + $path.shift();
						
						/**
						 *	Construct message for workflow
						**/
						for(var $j in $path){
							//$path[$j] = unescape($path[$j]);
							$message[$j] = $path[$j];
						}
						
						if($parts[1] || false){
							var $req = $parts[1].split('/');
							for(var $i = 1, $len=$req.length; $i<$len; $i+=2){
								//$req[$i + 1] = unescape($req[$i + 1]);
								$message[$req[$i]] = $req[$i + 1];
							}
						}

						break;
					
					default :
						/**
						 *	Parse navigator
						 **/
						var $req = $navigator.split(':');
						var $index = $req[0];
						
						/**
						 *	Construct message for workflow
						**/
						for(var $i=1, $len=$req.length; $i<$len; $i++){
							var $param = ($req[$i]).split('=');
							var $arg = $param[1];
							$arg = $arg.replace(/~/g, '=');
							//$arg = unescape($arg);
							$message[$param[0]] = $arg;
						}					
						break;

				}
				
				/**
				 *	Run the workflow and return the valid value
				**/
				if($navigators[$index] || false){
					$message['service'] = $navigators[$index];
					$message = this.run($message, $memory || {});
					return $message['valid'];
				}
				
				return false;
			}
		}
	};
})();

/**
 *	@short codes SB
**/
var SB = {
	R : {
		s : Snowblozm.Registry.save,
		g : Snowblozm.Registry.get,
		r : Snowblozm.Registry.remove,
		a : Snowblozm.Registry.add,
		l : Snowblozm.Registry.load,
		rN : Snowblozm.Registry.removeNavigator
	},
	K : {
		e : Snowblozm.Kernel.execute,
		r : Snowblozm.Kernel.run,
		l : Snowblozm.Kernel.launch
	}
};
/**
 * @initialize FireSpark
**/
var FireSpark = {
	core : {
		service : {},
		workflow : {},
		helper : {},
		constant : {}
	},
	ui : {
		service : {},
		workflow : {},
		helper : {},
		constant : {},
		template : {}
	},
	smart : {
		service : {},
		workflow : {},
		helper : {},
		constant : {}
	}
};

var FS = {
	c : {
		s : FireSpark.core.service,
		w : FireSpark.core.workflow,
		h : FireSpark.core.helper,
		c : FireSpark.core.constant
	},
	u : {
		s : FireSpark.ui.service,
		w : FireSpark.ui.workflow,
		h : FireSpark.ui.helper,
		c : FireSpark.ui.constant,
		t : FireSpark.ui.template
	},
	s : {
		s : FireSpark.smart.service,
		w : FireSpark.smart.workflow,
		h : FireSpark.smart.helper,
		c : FireSpark.smart.constant
	}
};

function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function is_numeric(n){
	return !isNaN(Number(n));
}

function unique($array){
   var u = {}, a = [];
   for(var i = 0, l = $array.length; i < l; ++i){
      if($array[i] in u)
         continue;
      a.push($array[i]);
      u[$array[i]] = 1;
   }
   return a;
}
/**
 *	@service LoadAjax
 *	@desc Uses AJAX to load data from server
 *
 *	@param url string [memory]
 *	@param data object [memory] optional default ''
 *	@param type string [memory] optional default 'json'
 *	@param request string [memory] optional default 'POST'
 *	@param process boolean [memory] optional default false
 *	@param mime string [memory] optional default 'application/x-www-form-urlencoded'
 *	@param sync boolean [memory] optional default false
 *
 *	@param workflow Workflow [memory]
 *	@param errorflow	Workflow [memory] optional default false
 *	@param function startfn Start Function [memory] optional default false
 *	@param function endfn End Function [memory] optional default false
 *	@param stop boolean [memory] optional default false
 *	@param validity boolean [memory] optional default false
 *
 *	@return data string [memory]
 *	@return error string [memory] optional
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.core.service.LoadAjax = {
	input : function(){
		return {
			required : ['url', 'workflow'],
			optional : { 
				data : '', 
				type : 'json', 
				request : 'POST', 
				process : false, 
				mime : 'application/x-www-form-urlencoded' ,
				errorflow : false,
				stop : false,
				validity : false,
				sync : false
			}
		}
	},
	
	run : function($memory){
		
		FireSpark.core.helper.LoadBarrier.start();
		
		var $mem = {};
		for(var $i in $memory){
			$mem[$i] = $memory[$i];
		}
		
		/**
		 *	Load data from server using AJAX
		**/
		$.ajax({
			url: $memory['url'],
			data: $memory['data'],
			dataType : $memory['type'],
			type : $memory['request'],
			processData : $memory['process'],
			contentType : $memory['mime'],
			async : $memory['sync'] ? false : true,
			
			success : function($data, $status, $request){
				$mem['data'] = $data;
				//$mem['status'] = $status;
				
				if($mem['validity'] && ( ($mem['data']['valid'] === false) ||  (($mem['data']['message'] || false) && $mem['data']['message']['valid'] === false) )){
					/**
					 *	Run the errorflow if any
					**/
					try {
						if($memory['errorflow']){
							Snowblozm.Kernel.execute($memory['errorflow'], $mem);
						}
						FireSpark.core.helper.LoadBarrier.end();
					} catch($id) {
						FireSpark.core.helper.LoadBarrier.end();
						if(console || false){
							console.log('Exception : ' + $id);
						}
					}
				}
				else {
					/**
					 *	Run the workflow
					**/
					try {
						Snowblozm.Kernel.execute($memory['workflow'], $mem);
						FireSpark.core.helper.LoadBarrier.end();
					} catch($id) {
						FireSpark.core.helper.LoadBarrier.end();
						if(console || false){
							console.log('Exception : ' + $id);
						}
					}
				}
			},
			
			error : function($request, $status, $error){
				$mem['error'] = $error;
				//$mem['status'] = $status;
				$mem['data'] = FireSpark.core.constant.loaderror + '<span class="hidden"> [Error : ' + $error + ']</span>';
				
				/**
				 *	Run the errorflow if any
				**/
				try {
					if($memory['errorflow']){
						Snowblozm.Kernel.execute($memory['errorflow'], $mem);
					}
					FireSpark.core.helper.LoadBarrier.end();
				} catch($id) {
					FireSpark.core.helper.LoadBarrier.end();
					if(console || false){
						console.log('Exception : ' + $id);
					}
				}
			}
		});
		
		/**
		 *	@return false 
		 *	to stop default browser event
		**/
		return { valid : $memory['stop'] };
	},
	
	output : function(){
		return [];
	}
};
/**
 *	@service LoadIframe
 *	@desc Uses IFRAME to load data from server
 *
 *	@param agent string [memory] 
 *	@param type string [memory] optional default 'json' ('json', 'html')
 *
 *	@param workflow Workflow [memory]
 *	@param errorflow	Workflow [memory] optional default false
 *
 *	@return data string [memory]
 *	@return error string [memory] optional
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.core.service.LoadIframe = {
	input : function(){
		return {
			required : ['agent', 'workflow'],
			optional : { 
				type : 'json', 
				errorflow : false
			}
		}
	},
	
	run : function($memory){
		
		//FireSpark.core.helper.LoadBarrier.start();
		
		var $mem = {};
		for(var $i in $memory){
			$mem[$i] = $memory[$i];
		}
		
		/**
		 *	Genarate unique framename
		**/
		var $d= new Date();
		var $framename = 'firespark_iframe_' + $d.getTime();
		
		/**
		 *	Set target attribute to framename in agent
		**/
		$($memory['agent']).attr('target', $framename);
		
		/**
		 *	Create IFRAME and define callbacks
		**/
		var $iframe = $('<iframe id="' + $framename + '" name="'+ $framename + '" style="width:0;height:0;border:0px solid #fff;"></iframe>')
			.insertAfter($memory['agent'])
			.bind('load', function(){
				try {
					var $frame = FireSpark.core.helper.windowFrame($framename);
					var $data = $frame.document.body.innerHTML;
					switch($memory['type']){
						case 'html' :
							$mem['data'] = $data;
							break;
						case 'json' :
						default :
							try {
								$data = $($data).html();
							}catch($id) { 
								if(console || false){ console.log('Exception : ' + $id); }
							}
							$mem['data'] = $.parseJSON($data);
							break;
					}
					
					/**
					 *	Run the workflow
					**/
					try {
						Snowblozm.Kernel.execute($memory['workflow'], $mem);
						//FireSpark.core.helper.LoadBarrier.end();
					} catch($id) {
						//FireSpark.core.helper.LoadBarrier.end();
						if(console || false){
							console.log('Exception : ' + $id);
						}
					}
				}
				catch($error){
					if(console || false){
						console.log('Exception : ' + $error);
					}
					
					$mem['error'] = $error.description;
					$mem['result'] = FireSpark.core.constant.loaderror + '<span class="hidden"> [Error :' + $error.description + ']</span>';
					$mem['data'] = {
						valid : false,
						msg : FireSpark.core.constant.loaderror,
						code : 500,
						details : $error.description
					};
					
					/**
					 *	Run the errorflow if any
					**/
					try {
						if($memory['errorflow']){
							Snowblozm.Kernel.execute($memory['errorflow'], $mem);
						}
						//FireSpark.core.helper.LoadBarrier.end();
					} catch($id) {
						//FireSpark.core.helper.LoadBarrier.end();
						if(console || false){
							console.log('Exception : ' + $id);
						}
					}
				}
			})
			.bind('error', function($error){
				$mem['error'] = $error;
				$mem['result'] = FireSpark.core.constant.loaderror;
				
				/**
				 *	Run the errorflow if any
				**/
				try {
					if($memory['errorflow']){
						Snowblozm.Kernel.execute($memory['errorflow'], $mem);
					}
					//FireSpark.core.helper.LoadBarrier.end();
				} catch($id) {
					//FireSpark.core.helper.LoadBarrier.end();
					if(console || false){
						console.log('Exception : ' + $id);
					}
				}
			});
			
		/**
		 *	Remove IFRAME after timeout (150 seconds)
		**/
		window.setTimeout(function(){
			$iframe.remove();
		}, 150000);
		
		/**
		 *	@return true 
		 *	to continue default browser event with target on iframe
		**/
		return { valid : true };
	},
	
	output : function(){
		return [];
	}
};
/**
 *	@helper readControl
 *
 *	@param control Control character
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.core.helper.readControl = function($control){
	switch($control){
		case 'info' :
			return 'View Entity';
		case 'edit' :
			return 'Edit Entity';
		case 'list' :
			return 'List Children';
		case 'add' :
			return 'Add Children';
		case 'remove' :
			return 'Remove Children';
		default :
			return '';
			break;
	}
}
/**
 *	@helper readFileSize
 *
 *	@param size
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.core.helper.readFileSize = function(size){
	var kb = size/1024.0;
	if(kb > 1024.0){
		var mb = kb/1024.0;
		return mb.toFixed(2) + ' MB';
	}
	return kb.toFixed(2) + ' KB';
}
/**
 *	@helper readGender 
 *
 *	@param ch gender character
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.core.helper.readGender = function($ch){
	switch($ch){
		case 'M' :
			return 'Male';
		case 'F' :
			return 'Female';
		case 'N' :
		default :
			return '';
			break;
	}
}
/**
 *	@service ContainerRemove
 *	@desc Used to remove container
 *
 *	@param key string [memory] optional default 'ui-global'
 *	@param id long int [memory] optional default '0'
 *	@param ins string [memory] optional default '#ui-global-0'
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.ContainerRemove = {
	input : function(){
		return {
			optional : { 
				key : 'ui-global', 
				id : '0',
				ins : '#ui-global-0'
			}
		}
	},
	
	run : function($memory){		
		$memory['key'] = $memory[0] || $memory['key'];
		$memory['id'] = $memory[1] || $memory['id'];
		$memory['ins'] = $memory[2] || $memory['ins'];
		
		var $instance = $memory['key']+'-'+$memory['id'];

		$memory = Snowblozm.Kernel.execute([{
			service : FireSpark.ui.service.ElementContent,
			element : '.' + $instance,
			select : true,
			action : 'remove',
			animation : 'none'
		},{
			service : FireSpark.smart.workflow.InterfaceTile,
			input : { cntr : 'ins' }
		}], $memory);
		
		$memory['valid'] = false;
		return $memory;
	},
	
	output : function(){
		return [];
	}
};
/**
 *	@service ContainerRender
 *	@desc Used to render container
 *
 *	@param key string [memory] optional default 'ui-global'
 *	@param id long int [memory] optional default '0'
 *	@param ins string [memory] optional default '#ui-global-0'
 *	@param root object [memory] optional default false
 *	@param bg boolean [memory] optional default false
 *	@param tpl template [memory] optional default [{ '#tpl-default' : '>.bands' }]
 *	@param tile string [memory] optional false
 *	@param act string [memory] optional default 'first' ('all', 'first', 'last', 'remove')
 *	@param data object [memory] optional default {}
 *	@param anm string [memory] optional default 'fadein' ('fadein', 'fadeout', 'slidein', 'slideout')
 *	@param dur integer [memory] optional default 1000
 *	@param dly integer [memory] optional default 0
 *	@param errorflow workflow [memory] optional default { service : FireSpark.ui.workflow.TemplateApply, tpl : 'tpl-default' }
 *	@param mv boolean [memory] optional default FireSpark.smart.constant.moveup
 *	@param mvdur integer [memory] optional default FireSpark.smart.constant.moveduration
 *
 *	@return element element [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.ContainerRender = {
	input : function(){
		return {
			optional : { 
				key : 'ui-global', 
				id : '0',
				ins : '#ui-global-0',
				root : false,
				bg : false,
				tpl : [{ '#tpl-default' : '>.bands' }],
				tile : false,
				act : 'first',
				data : {},
				anm : 'fadein',
				dur : 1000,
				dly : 0,
				errorflow : { service : FireSpark.ui.workflow.TemplateApply, tpl : 'tpl-default' },
				mv : FireSpark.smart.constant.moveup,
				mvdur : FireSpark.smart.constant.moveduration
			}
		}
	},
	
	run : function($memory){				
		if($memory['data']['valid'] || false){
			if($memory['data']['message'] || false){
				if($memory['data']['message']['id'] || false){
					$memory['id'] = $memory['data']['message']['id'];
				}
			}
			
			var $instance = $memory['key']+'-'+$memory['id'];
			
			FireSpark.smart.helper.dataState(FireSpark.smart.constant.initmsg, true);
			var $workflow = [{
				service : FireSpark.ui.service.ElementContent,
				element : '.' + $instance + FireSpark.ui.constant.replacesel,
				select : true,
				action : 'remove'
			}];
			
			var $tpl = $memory['tpl'];
			for(var $i in $tpl){
				$workflow = $workflow.concat([{
					service : FireSpark.ui.workflow.TemplateApply,
					input : {
						action : 'act',
						duration : 'dur'
					},
					element : $memory['ins'] + $tpl[$i]['sel'],
					select : true,
					template : $tpl[$i]['tpl'],
					animation : 'none',
					delay : 0
				}]);
			}
			
			if($memory['bg'] === false){
				$workflow.push({
					service : FireSpark.smart.workflow.InterfaceTile,
					input : { cntr : 'ins' }
				});
			}
			
			return Snowblozm.Kernel.execute($workflow, $memory);
		}
		else if($memory['errorflow']) {
			/**
			 *	Run the errorflow
			**/
			return Snowblozm.Kernel.execute($memory['errorflow'], $memory);
		}
		else return { valid : false };
	},
	
	output : function(){
		return ['element'];
	}
};
/**
 *	@service ElementContent
 *	@desc Fills element with content and animates it or removes it and returns element in memory
 *
 *	@param element string [memory]
 *	@param select boolean [memory] optional default false
 *	@param data html/text [memory] optional default ''
 *	@param animation string [memory] optional default 'fadein' ('fadein', 'fadeout', 'slidein', 'slideout', 'none')
 *	@param duration integer [memory] optional default 1000
 *	@param delay integer [memory] optional default 0
 *	@param action string [memory] optional default 'all' ('all', 'first', 'last', 'remove', 'replace', 'hide', 'show')
 *
 *	@return element element [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.ElementContent = {
	input : function(){
		return {
			required : ['element'],
			optional : { 
				select : false,
				data : '',
				animation : 'fadein',
				duration : 1000,
				delay : 0,
				action : 'all'
			}
		};
	},
	
	run : function($memory){
		if($memory['select']){
			var $element = $($memory['element']);
			if(!$element.length && $memory['action'] != 'remove'){
				$element = $(FireSpark.ui.constant.maindiv);
			}
		}
		else {
			$element = $memory['element'];
		}
		
		var $data = $memory['data'];
		var $animation = $memory['animation'];
		var $duration = $memory['duration'];
		
		if($.isPlainObject($data) && $memory['action'] != 'remove' && $data['html'] || false){
			$data = $("<div/>").html($data['html']).text();
		}
		
		if($animation == 'fadein' || $animation == 'slidein'){
			$element.hide();
		}
		
		switch($memory['action']){
			case 'all' :
				$element = $element.html($data);
				$element.trigger('load');
				break;
			
			case 'first' :
				$element = $element.prepend($data);
				$element.trigger('load');
				break;
			
			case 'last' :
				$element = $element.append($data);
				$element.trigger('load');
				break;
			
			case 'replace' :
				$element = $($data).replaceAll($element);
				$element.trigger('load');
				//$element.children().trigger('load');
				break;
				
			case 'remove' :
				$element.remove();
				break;
				
			default :
				break;
		}
		
		if($memory['action'] != 'remove'){
			$element.stop(true, true).delay($memory['delay']);
			
			switch($animation){
				case 'fadein' :
					$element.fadeIn($duration);
					break;
				case 'fadeout' :
					$element.fadeOut($duration);
					break;
				case 'slidein' :
					$element.slideDown($duration);
					break;
				case 'slideout' :
					$element.slideUp($duration);
					break;
				case 'none' :
					break;
				default :
					$element.html('Animation type not supported').fadeIn($duration);
					break;
			}
		}
		
		$memory['element'] = $element;
		$memory['valid'] = true;
		return $memory;
	},
	
	output : function(){
		return ['element'];
	}
};
/**
 *	@service ElementSection
 *	@desc Toggles element with another content and animates it and returns element in memory
 *
 *	@param element string [memory] optional default parent of content
 *	@param select boolean [memory] optional default false
 *	@param content string [memory] optional default false
 *	@param child string [memory] optional default '.tile-content'
 *	@param none boolean [memory] optional default false
 *	@param animation string [memory] optional default 'fadein' ('fadein', 'slidein')
 *	@param duration integer [memory] optional default 1000
 *	@param delay integer [memory] optional default 0
 *
 *	@return element element [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.ElementSection = {
	input : function(){
		return {
			optional : { 
				element : false,
				select : false,
				content : false,
				child : '.tile-content',
				none : false,
				animation : 'fadein',
				duration : 500,
				delay : 0
			}
		};
	},
	
	run : function($memory){
		if($memory['select'] && $memory['element']){
			var $element = $($memory['element']);
			if(!$element.length){
				return { valid : false };
			}
		}
		else if($memory['select'] && $memory['content']){
			var $element = $($memory['content']).parent();
			if(!$element.length){
				return { valid : false };
			}
		}
		else {
			$element = $memory['element'];
		}
		
		$element.children($memory['child']).hide();
		
		if(!$memory['none']){
			if($memory['content']){
				$element = $element.children($memory['content']);
			}
			else {
				$element = $element.children($memory['child']).eq(0);
			}
			
			var $animation = $memory['animation'];
			var $duration = $memory['duration'];
			
			$element.trigger('load');
			$element.delay($memory['delay']);
			
			switch($animation){
				case 'fadein' :
					$element.fadeIn($duration);
					break;
				case 'slidein' :
					$element.slideDown($duration);
					break;
				default :
					$element.html('Animation type not supported').fadeIn($duration);
					break;
			}
		}
		
		$memory['element'] = $element;
		$memory['valid'] = false;
		return $memory;
	},
	
	output : function(){
		return ['element'];
	}
};
/**
 *	@service ElementTab
 *	@desc Creates a new tab and returns the element
 *
 *	@param tabui string [memory]
 *  @param title string [memory]
 *  @param autoload boolean [memory] optional default false
 *  @param taburl string [memory] optional default false
 *
 *	@return element Element [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.ElementTab = {
	input : function(){
		return {
			required : ['tabui', 'title'],
			optional : { autoload : false,	taburl : false }
		};
	},
	
	run : function($memory){
		var $tabui = Snowblozm.Registry.get($memory['tabui']);
		$memory['element'] = $tabui.add($memory['title'], $memory['autoload'], $memory['taburl']);
		$memory['valid'] = true;
		return $memory;
	},
	
	output : function(){
		return ['element'];
	}
};
/**
 *	@template Default
**/
FireSpark.ui.template.Default = $.template('\
	<span class="{{if valid}}success{{else}}error{{/if}}">{{html msg}}</span>\
	<span class="hidden">${details}</span>\
');

Snowblozm.Registry.save('tpl-default', FireSpark.ui.template.Default);
/**
 *	@service TemplateApply
 *	@desc Applies template
 *
 *	@param template Template [memory]
 *	@param data object [memory] optional default {}
 *
 *	@return result html [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.TemplateApply = {
	input : function(){
		return {
			required : ['template'],
			optional : { data : {} }
		};
	},
	
	run : function($memory){
		$memory['result'] = $.tmpl($memory['template'], $memory['data']);
		$memory['valid'] = true;
		return $memory;
	},
	
	output : function(){
		return ['result'];
	}
};
/**
 *	@service TemplateRead
 *	@desc Reads template definition into memory
 *
 *	@param template string [memory] optional default 'tpl-default' (FireSpark.jquery.template.Default)
 *
 *	@param result Template [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.ui.service.TemplateRead = {
	input : function(){
		return {
			optional : { template : 'tpl-default' }
		};
	},
	
	run : function($memory){
		$tpl = $memory['template'];
		$template = Snowblozm.Registry.get($tpl);
		
		if(!$template && $tpl.charAt(0) == '#'){
			$template = $.template($tpl);
			if($template){
				Snowblozm.Registry.save($tpl, $template);
			}
		}
	
		$memory['result'] = $template;
		$memory['valid'] = ($template || false) ? true : false;
		return $memory;
	},
	
	output : function(){
		return ['result'];
	}
};
/**
 *	@template Tiles
**/
FireSpark.ui.template.Tiles = $.template('\
	<ul class="hover-menu horizontal tls-${key}-${id}">\
		<span class="tilehead">\
			${tilehead}\
			{{if FireSpark.core.helper.dataEquals(close, true)}}\
				<a class="launch close hover" href="#/close/${key}/${id}/${ins}/" title="Close"></a>\
			{{/if}}\
		</span>\
		{{each tiles}}\
		<li>\
			{{if FireSpark.core.helper.dataEquals(!privileged || (privileged && admin), true)}}\
				{{if tpl}}\
					{{tmpl tpl}}\
				{{else urlhash}}\
					<a href="${urlhash}" class="navigate tile ${style}">${name}</a>\
				{{else}}\
					<a href="!/view/${tile}-${id}" class="navigate tile ${style}">${name}</a>\
				{{/if}}\
			{{/if}}\
		</li>\
		{{/each}}\
	</ul>\
');

Snowblozm.Registry.save('tpl-tiles', FireSpark.ui.template.Tiles);

/**
 *	@template Bands
**/
FireSpark.ui.template.Bands = $.template('\
	{{each tiles}}\
		<span></span>\
		{{if $value.tiletpl}}\
			{{tmpl $value.tiletpl}}\
		{{/if}}\
	{{/each}}\
');

Snowblozm.Registry.save('tpl-bands', FireSpark.ui.template.Bands);

/**
 *	@template Container
**/
FireSpark.ui.template.Container = $.template('\
	<div class="tiles"></div>\
	{{if inline}}<div class="bands"></div>{{/if}}\
');

Snowblozm.Registry.save('tpl-container', FireSpark.ui.template.Container);
/**
 *	@service DataImport
 *	@desc Uses AJAX to load content from server and saves in dom
 *
 *	@param imports array [memory]
 *	@param workflow Workflow [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.smart.service.DataImport = {
	input : function(){
		return {
			required : ['imports', 'workflow']
		}
	},
	
	run : function($memory){
		/**
		 *	Set barrier
		**/
		var $workflow = $memory['workflow'];
		var $imports = $memory['imports'];
		
		FireSpark.core.helper.LoadBarrier.barrier(function($args){
			var $flag = false;
			var $imports = $args['imports'];
			
			for(var $i in $imports){
				var $key = 'FIRESPARK_IMPORT_' + $imports[$i];
				if(Snowblozm.Registry.get($key) || false){
				} else {
					$flag = true;
					break;
				}
			}
				
			if($flag || false){
				FireSpark.smart.helper.dataState(FireSpark.smart.constant.loaderror);
				return { valid : false };
			}
			
			$args['memory']['valid'] = true;
			Snowblozm.Kernel.execute($args['workflow'], $args['memory']);
		}, {
			workflow : $workflow,
			imports : $imports,
			memory : $memory
		});
		
		/**
		 *	Load imports
		**/
		var $barrier = false;
		
		for(var $i in $imports){
			var $key = 'FIRESPARK_IMPORT_' + $imports[$i];
			
			if(Snowblozm.Registry.get($key) || false){
			} else {
				if($barrier === false){
					$barrier = true;
					FireSpark.smart.helper.dataState(FireSpark.smart.constant.loadstatus);
				}
				
				Snowblozm.Kernel.execute([{
					service : FireSpark.core.service.LoadAjax,
					url : $imports[$i],
					type : 'html',
					request : 'GET',
					sync : FireSpark.smart.constant.importsync,
					workflow : [{
						service : FireSpark.core.service.DataRegistry,
						key : $key,
						value : true,
						check : true
					},{
						service : FireSpark.ui.service.ElementContent,
						element : FireSpark.smart.constant.importdiv,
						select : true,
						action : 'last',
						animation : 'none',
						duration : 5
					}]
				}], {});
			}
		}
		
		/**
		 *	Finalize barrier
		**/
		if($barrier){
			return { valid : false };
		} else {
			FireSpark.core.helper.LoadBarrier.end();
			return { valid : false };
			//return Snowblozm.Kernel.execute($workflow, $memory);
		}
	},
	
	output : function(){
		return [];
	}
};
/**
 *	@service DataLoad
 *	@desc Uses AJAX and IFRAME to load data from server and saves in pool
 *
 *	@param url string [memory]
 *	@param data object [memory] optional default ''
 *	@param type string [memory] optional default 'json'
 *	@param request string [memory] optional default 'POST'
 *	@param process boolean [memory] optional default false
 *	@param mime string [memory] optional default 'application/x-www-form-urlencoded'
 *
 *	@param params array [memory] optional default []
 *	@param workflow Workflow [memory]
 *	@param errorflow	Workflow [memory] optional default false
 *	@param stop boolean [memory] optional default false
 *	@param validity boolean [memory] optional default false
 *
 *	@param force boolean [memory] optional default FireSpark.smart.constant.poolforce
 *	@param global boolean [memory] optional default false
 *	@param nocache boolean [memory] optional default false
 *	@param expiry integer [memory] optional default FireSpark.smart.constant.poolexpiry
 *
 *	@param iframe string [memory] optional default false
 *	@param agent string [memory] optional default root
 *	@param root element [memory] optional default false
 *
 *	@return data string [memory]
 *	@return error string [memory] optional
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
FireSpark.smart.service.DataLoad = {
	input : function(){
		return {
			required : ['url', 'workflow'],
			optional : { 
				data : '', 
				type : 'json', 
				request : 'POST', 
				process : false, 
				mime : 'application/x-www-form-urlencoded' ,
				params : [],
				errorflow : false,
				stop : false,
				validity : false,
				nocache : false,
				expiry : FireSpark.smart.constant.poolexpiry,
				force : FireSpark.smart.constant.poolforce,
				global : false,
				iframe : false,
				agent : false,
				root : false
			}
		}
	},
	
	run : function($memory){
		var $workflow = $memory['workflow'];
		var $key = 'FIRESPARK_SI_DATA_URL_' + $memory['url'] + '_DATA_' + $memory['data'] + '_TYPE_' + $memory['type'] + '_REQUEST_' + $memory['request'];
		//alert($key);
		
		if($memory['data'] === true) {
			$memory['data'] = '';
		}
		
		$workflow.unshift({
			service : FireSpark.core.service.DataPush,
			args : $memory['params'],
			output : { result : 'data' }
		});
		
		
		/**
		 *	Check AJAX
		**/
		if($memory['iframe']){
			$memory['agent'] = $memory['agent'] ? $memory['agent'] : $memory['root'];
			
			return Snowblozm.Kernel.run({
				service : FireSpark.core.service.LoadIframe,
				args : $memory['args']
			}, $memory);
		}
		else if($memory['force'] === false){
			/**
			 *	Check pool
			**/
			var $data = Snowblozm.Registry.get($key);
			
			if($data){
				$memory['data'] = $data;
				if($data['valid'] || false){
					/**
					 *	Run the workflow
					**/
					Snowblozm.Kernel.execute($workflow, $memory);
					return { valid : $memory['stop']};
				}
				else if($memory['errorflow']) {
					/**
					 *	Run the errorflow
					**/
					Snowblozm.Kernel.execute($memory['errorflow'], $memory);
					return { valid : $memory['stop']};
				}
			}
		}
		
		if($memory['nocache'] === false){
			$workflow.unshift({
				service : FireSpark.core.service.DataRegistry,
				input : { value : 'data' },
				key : $key,
				expiry : $memory['expiry']
			});
		}
		
		if($memory['global']){
			var $data = Snowblozm.Registry.get(FireSpark.smart.constant.globalkey);
			
			if($data){
				$memory['data'] = $data;
				if($data['valid'] || false){
					/**
					*	Run the workflow
					**/
					Snowblozm.Kernel.execute($workflow, $memory);
					return { valid : $memory['stop']};
				}
				else if($memory['errorflow']){
					/**
					 *	Run the errorflow
					**/
					Snowblozm.Kernel.execute($memory['errorflow'], $memory);
					return { valid : $memory['stop']};
				}
			}
		}
		
		/**
		 *	Load AJAX
		**/
		return Snowblozm.Kernel.run({
			service : FireSpark.core.service.LoadAjax,
			args : $memory['args'] || false,
			workflow : $workflow
		}, $memory);
	},
	
	output : function(){
		return [];
	}
};
/**
 *	@config FireSpark.core.constant
**/
FireSpark.core.constant = {
	validations : {
		required : {
			cls : '.required',
			helper : FireSpark.core.helper.CheckRequired
		},
		email : {
			cls : '.email',
			helper : FireSpark.core.helper.CheckEmail
		},
		match : {
			cls : '.match',
			helper : FireSpark.core.helper.CheckMatch
		}
	},
	validation_status : 'span',
	loaderror : '<span class="error">Error Loading Data</span>'
}

/**
 *	@config FireSpark.ui.constant
**/
FireSpark.ui.constant = {
	transforms : {
		uibutton : {
			cls : '.uibutton',
			helper : FireSpark.ui.helper.transformButton,
			config : {}
		},
		ckeditor : {
			cls : '.ckeditor',
			helper : FireSpark.ui.helper.transformCKEditor,
			config : {}
		},
		wysiwyg : {
			cls : '.wysiwyg',
			helper : FireSpark.ui.helper.transformWysiwyg,
			config : {}
		},
		uitabpanel : {
			cls : '.uitabpanel',
			helper : FireSpark.ui.helper.transformTabpanel,
			config : { 
				savekey : 'tabpanel',
				select : false, 
				cache : false,	
				collapsible : false, 
				event : 'click', 
				tablink : false, 
				indexstart : 0 
			}
		}
	},
	maindiv : '#ui-global-0',
	replacesel : ', .ui-replace',
	defaulttpl : 'tpl-default'
};

/**
 *	@config FireSpark.smart.constant
**/
FireSpark.smart.constant = {
	urlstart : '', // '?/'
	globalkey : 'ui-global-data',
	statusdiv : '#load-status',
	statusdelay : 1500,
	statusduration : 1500,
	loaderror : '<span class="error">Error Loading Data</span>',
	loadstatus : '<span class="state loading">Loading ...</span>',
	loadmsg : '<span class="loading">Loading ...</span>',
	initmsg : '<span class="state">Initializing ...</span>',
	cnfmsg : 'Are you sure you want to continue ?',
	importdiv : '#ui-imports',
	importroot : 'ui/import/',
	importext : '.json',
	importsync : false,
	defaultkey : 'people.person.info',
	defaulturl : 'run.php',
	tileuiprefix : '#ui-global-',
	tileuicntr : '.bands',
	tileuisection : '.tile-content',
	moveup : false,
	moveduration: 850,
	poolexpiry : 150,
	poolforce : false,
	config : [],
	defaultln : '#sync',
	uicache : true,
	dtclass : '.datatable',
	readflow : function(){ return false; },
	datatype : 'json',
	datareq : 'POST',
	readvld : true
};
