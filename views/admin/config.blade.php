@load('config.scss')

<div class="x_page-header">
	<h1>{{ $lang->cmd_allbandazole }}</h1>
</div>

<ul class="x_nav x_nav-tabs">
	<li @class(['x_active' => $act == 'dispAllbandazoleAdminConfig'])">
		<a href="@url(['module' => 'admin', 'act' => 'dispAllbandazoleAdminConfig'])">{$lang->cmd_allbandazole_general_config}</a>
	</li>
</ul>

<form class="x_form-horizontal" action="./" method="post" id="allbandazole">
	<input type="hidden" name="module" value="allbandazole" />
	<input type="hidden" name="act" value="procAllbandazoleAdminInsertConfig" />
	<input type="hidden" name="success_return_url" value="{{ getRequestUriByServerEnviroment() }}" />
	<input type="hidden" name="error_return_url" value="{{ getRequestUriByServerEnviroment() }}" />
	<input type="hidden" name="xe_validator_id" value="modules/allbandazole/tpl/config/1" />

	@if (!empty($XE_VALIDATOR_MESSAGE) && $XE_VALIDATOR_ID === 'modules/allbandazole/tpl/config/1')
		<div class="message {{ $XE_VALIDATOR_MESSAGE_TYPE }}">
			<p>{{ $XE_VALIDATOR_MESSAGE }}</p>
		</div>
	@endif

	<section class="section">
		<div class="x_control-group">
			<label class="x_control-label" for="enabled">{{ $lang->cmd_allbandazole_enabled }}</label>
			<div class="x_controls">
				<select name="enabled" id="enabled">
					<option value="Y" @selected(!empty($config->enabled))>{{ $lang->cmd_yes }}</option>
					<option value="N" @selected(!$config->enabled)>{{ $lang->cmd_no }}</option>
				</select>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="x_control-group">
			<label class="x_control-label" for="user_agents">{{ $lang->cmd_allbandazole_user_agents }}</label>
			<div class="x_controls">
				<textarea name="user_agents" id="user_agents" class="x_full-width">{{ implode("\n", $config->user_agents) . "\n" }}</textarea>
				<p class="x_help-block">{{ $lang->msg_allbandazole_multiline }}</p>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="x_control-group">
			<label class="x_control-label" for="ip_blocks">{{ $lang->cmd_allbandazole_ip_blocks }}</label>
			<div class="x_controls">
				<textarea name="ip_blocks" id="ip_blocks" class="x_full-width">{{ implode("\n", $config->ip_blocks) . "\n" }}</textarea>
				<p class="x_help-block">{{ $lang->msg_allbandazole_multiline }}</p>
			</div>
		</div>
	</section>

	<div class="btnArea x_clearfix">
		<button type="submit" class="x_btn x_btn-primary x_pull-right">{{ $lang->cmd_registration }}</button>
	</div>

</form>
