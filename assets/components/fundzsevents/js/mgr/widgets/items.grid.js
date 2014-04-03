fundzsEvents.grid.Items = function(config) {
	config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
	Ext.applyIf(config,{
		id: 'fundzsevents-grid-items'
		,url: fundzsEvents.config.connector_url
		,baseParams: {
			action: 'mgr/item/getlist'
		}
		,fields: ['id','name','city','address','owner_fullname']
		,autoHeight: true
		,paging: true
		,remoteSort: true
        ,sm: this.sm
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 30}
			,{header: _('name'),dataIndex: 'name',width: 200}
			,{header: _('fundzsevents_event_city'),dataIndex: 'city',width: 80}
			,{header: _('fundzsevents_event_address'),dataIndex: 'address',width: 150}
			,{header: _('fundzsevents_event_owner'),dataIndex: 'owner_fullname',width: 100}
		]
		,tbar: [{
			text: _('fundzsevents_event_create')
			,handler: this.createItem
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateItem(grid, e, row);
			}
		}
	});
	fundzsEvents.grid.Items.superclass.constructor.call(this,config);
};
Ext.extend(fundzsEvents.grid.Items,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
        var cs = this.getSelectedAsList();
        var m = [];
        if (cs.split(',').length > 1) {
            m.push({
    			text: _('fundzsevents_events_remove')
    			,handler: this.removeSelected
    		});
        } else {
    		m.push({
    			text: _('fundzsevents_event_update')
    			,handler: this.updateItem
    		});
    		m.push('-');
    		m.push({
    			text: _('fundzsevents_event_remove')
    			,handler: this.removeItem
    		});
        }
		this.addContextMenuItem(m);
	}

	,createItem: function(btn,e) {
		if (!this.windows.createItem) {
			this.windows.createItem = MODx.load({
				xtype: 'fundzsevents-window-item-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createItem.fp.getForm().reset();
		this.windows.createItem.show(e.target);
	}

	,updateItem: function(btn,e,row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: fundzsEvents.config.connector_url
			,params: {
				action: 'mgr/item/get'
				,id: id
			}
			,listeners: {
				success: {fn:function(r) {
					if (!this.windows.updateItem) {
						this.windows.updateItem = MODx.load({
							xtype: 'fundzsevents-window-item-update'
							,record: r
							,listeners: {
								'success': {fn:function() { this.refresh(); },scope:this}
							}
						});
					}
					this.windows.updateItem.fp.getForm().reset();
					this.windows.updateItem.fp.getForm().setValues(r.object);
					this.windows.updateItem.show(e.target);
				},scope:this}
			}
		});
	}

	,removeItem: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('fundzsevents_event_remove')
			,text: _('fundzsevents_event_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/item/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

    ,getSelectedAsList: function() {
        var sels = this.getSelectionModel().getSelections();
        if (sels.length <= 0) return false;

        var cs = '';
        for (var i=0;i<sels.length;i++) {
            cs += ','+sels[i].data.id;
        }
        cs = cs.substr(1);
        return cs;
    }

    ,removeSelected: function(act,btn,e) {
        var cs = this.getSelectedAsList();
        if (cs === false) return false;

        MODx.msg.confirm({
			title: _('fundzsevents_events_remove')
			,text: _('fundzsevents_events_remove_confirm')
			,url: this.config.url
			,params: {
                action: 'mgr/items/remove'
                ,items: cs
            }
            ,listeners: {
                'success': {fn:function(r) {
                    this.getSelectionModel().clearSelections(true);
                    this.refresh();
                       var t = Ext.getCmp('modx-resource-tree');
                       if (t) { t.refresh(); }
                },scope:this}
            }
        });
        return true;
    }
});
Ext.reg('fundzsevents-grid-items',fundzsEvents.grid.Items);




fundzsEvents.window.CreateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('fundzsevents_event_create')
		,id: this.ident
		,height: 200
		,width: 475
		,url: fundzsEvents.config.connector_url
		,action: 'mgr/item/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'fundzsevents-'+this.ident+'-name',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('fundzsevents_event_city'),name: 'city',id: 'fundzsevents-'+this.ident+'-city',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'fundzsevents-'+this.ident+'-description',height: 150,anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('fundzsevents_event_owner'),name: 'owner',id: 'fundzsevents-'+this.ident+'-owner',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('fundzsevents_event_address'),name: 'address',id: 'fundzsevents-'+this.ident+'-address',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('fundzsevents_event_comment'),name: 'comment',id: 'fundzsevents-'+this.ident+'-comment',height: 150, anchor: '99%'}
            
            /*{header: _('id'),dataIndex: 'id',width: 70}
			,{header: _('name'),dataIndex: 'name',width: 200}
			,{header: _('city'),dataIndex: 'city',width: 200}
			,{header: _('description'),dataIndex: 'description',width: 250}
			,{header: _('owner'),dataIndex: 'owner',width: 70}*/
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	fundzsEvents.window.CreateItem.superclass.constructor.call(this,config);
};
Ext.extend(fundzsEvents.window.CreateItem,MODx.Window);
Ext.reg('fundzsevents-window-item-create',fundzsEvents.window.CreateItem);


fundzsEvents.window.UpdateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('fundzsevents_event_update')
		,id: this.ident
		,height: 200
		,width: 475
		,url: fundzsEvents.config.connector_url
		,action: 'mgr/item/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'fundzsevents-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'fundzsevents-'+this.ident+'-name',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('fundzsevents_event_city'),name: 'city',id: 'fundzsevents-'+this.ident+'-city',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'fundzsevents-'+this.ident+'-description',height: 150,anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('fundzsevents_event_owner'),name: 'owner',id: 'fundzsevents-'+this.ident+'-owner',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('fundzsevents_event_address'),name: 'address',id: 'fundzsevents-'+this.ident+'-address',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('fundzsevents_event_comment'),name: 'comment',id: 'fundzsevents-'+this.ident+'-comment',height: 150, anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	fundzsEvents.window.UpdateItem.superclass.constructor.call(this,config);
};
Ext.extend(fundzsEvents.window.UpdateItem,MODx.Window);
Ext.reg('fundzsevents-window-item-update',fundzsEvents.window.UpdateItem);