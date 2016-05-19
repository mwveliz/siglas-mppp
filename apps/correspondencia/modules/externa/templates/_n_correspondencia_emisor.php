<div class="sf_admin_form_row sf_admin_text">
<?php if ($sf_user->hasFlash('error_correlativo')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_correlativo'); ?></div>
<?php endif; ?>
    <div>
        <label for="n_correspondencia_emisor">Nº de Entrada</label>
        <div class="content">
            <?php
                if($sf_user->getAttribute('nueva_recepcion_edit')) { ?>
                    <font class="f19b" style="background-color: #F1F300"><?php echo $form['n_correspondencia_emisor']->getValue(); ?></font>
                    <?php
                    $sf_user->setAttribute('unidad_correlativo_id',$form['unidad_correlativo_id']->getValue());
                    $sf_user->setAttribute('unidad_correlativo',$form['n_correspondencia_emisor']->getValue());
                } else { ?>
                    <font class="f19b" style="background-color: #F1F300;">
                        <?php echo $sf_user->getAttribute('unidad_correlativo'); ?>
                    </font>
            <?php } ?>
        </div>
    </div>
</div>

<div style="position: relative;">
    <div style="position: absolute; left: 440px; top: 68px;">


        <select name="correspondencia_correspondencia[f_envio][hour]" id="correspondencia_correspondencia_f_envio_hour">
            <option value="" selected="selected"></option>
            <option value="0">12 AM</option>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>

            <option value="4">04</option>
            <option value="5">05</option>
            <option value="6">06</option>
            <option value="7">07</option>
            <option value="8">08</option>
            <option value="9">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12 PM</option>

            <option value="13">01</option>
            <option value="14">02</option>
            <option value="15">03</option>
            <option value="16">04</option>
            <option value="17">05</option>
            <option value="18">06</option>
            <option value="19">07</option>
            <option value="20">08</option>
            <option value="21">09</option>

            <option value="22">10</option>
            <option value="23">11</option>
        </select>:
        <select name="correspondencia_correspondencia[f_envio][minute]" id="correspondencia_correspondencia_f_envio_minute">
            <option value="" selected="selected"></option>
            <option value="0">00</option>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>

            <option value="5">05</option>
            <option value="6">06</option>
            <option value="7">07</option>
            <option value="8">08</option>
            <option value="9">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>

            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>

            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>

            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>

            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>

            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>

            <option value="59">59</option>
        </select>
        &nbsp;&nbsp;Fecha Actual&nbsp;<input name="ha" id="fecha_actual_externo" type="checkbox">
    </div>
</div>

