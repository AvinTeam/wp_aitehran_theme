		<div class="wrap">
		    <h1>تنظیمات</h1>

		    <form method="post" action="" novalidate="novalidate">
		        <?php wp_nonce_field(config('app.key') . '_clock_setting_' . get_current_user_id()); ?>

		        <table class="form-table" role="presentation">

		            <tbody>

		                <tr>
		                    <th scope="row">وقفه در زمان</th>
		                    <td>
		                        <input name="clock[time_stamp]" type="number" min="0" value="<?php echo $time_stamp ?>">
		                        دقیقه
		                    </td>
		                </tr>

		                <tr>
		                    <th scope="row">مسابقه اینترنتی</th>
		                    <td>
		                        <fieldset><label for="internet1">
		                                <input name="clock[internet]" type="radio" id="internet1" value="1"
		                                    <?php checked(1, $internet)?>>فعال</label>

		                            <label for="internet0">

		                                <input name="clock[internet]" type="radio" id="internet0" value="0"
		                                    <?php checked(0, $internet)?>>غیر
		                                فعال</label>
		                        </fieldset>
		                    </td>
		                </tr>

		                <tr>
		                    <th scope="row">مسابقه تلویزیونی</th>
		                    <td>
		                        <fieldset>
		                            <label for="tv1"><input name="clock[tv]" type="radio" id="tv1" value="1"
		                                    <?php checked(1, $tv)?>>فعال</label>

		                            <label for="tv0"><input name="clock[tv]" type="radio" id="tv0" value="0"
		                                    <?php checked(0, $tv)?>>غیر فعال</label>
		                        </fieldset>
		                    </td>
		                </tr>
		            </tbody>
		        </table>


		        <p class="submit">
		            <button type="submit" name="act" id="submit" value="update-clock-setting"
		                class="button button-primary">ذخیره</button>
		        </p>
		    </form>
		</div>


		<div class="clear"></div>