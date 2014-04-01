var fundzsEvents = function(config) {
	config = config || {};
	fundzsEvents.superclass.constructor.call(this,config);
};
Ext.extend(fundzsEvents,Ext.Component,{
	page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('fundzsevents',fundzsEvents);

fundzsEvents = new fundzsEvents();