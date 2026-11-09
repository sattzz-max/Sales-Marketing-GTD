<section class="sec cta" id="contact">
  <div class="wrap narrow center reveal">
    <p class="eyebrow" style="color:var(--gold);"><?= e($t['contact']['eyebrow']) ?></p>
    <h2><?= e($t['contact']['title']) ?></h2>
    <p class="lead"><?= e($t['contact']['lead']) ?></p>
    <div style="margin-bottom:1.5rem;">
      <?= btn($t['contact']['btn_wa'], $main, 'btn btn-gold', 'cta_final') ?>
    </div>
    <form id="inquiry" class="inquiry" action="<?= e(route('inquiry.submit')) ?>" method="post" novalidate>
      <input type="hidden" name="_token" value="<?= e(csrf_token()) ?>">
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
      <label><?= e($t['contact']['form_name']) ?>
        <input name="name" required maxlength="120" placeholder="<?= e($t['contact']['ph_name']) ?>" autocomplete="name">
      </label>
      <label><?= e($t['contact']['form_comp']) ?>
        <input name="company" maxlength="120" placeholder="<?= e($t['contact']['ph_comp']) ?>" autocomplete="organization">
      </label>
      <label><?= e($t['contact']['form_contact']) ?>
        <input name="contact" required maxlength="160" placeholder="<?= e($t['contact']['ph_contact']) ?>">
      </label>
      <label><?= e($t['contact']['form_topic']) ?>
        <select name="topic">
          <?php 
          $sList = $services ?? $t['services']['items'];
          foreach ($sList as $s) {
            echo '<option>'.e($s['title']).'</option>';
          } 
          ?>
          <option><?= e($t['contact']['other']) ?></option>
        </select>
      </label>
      <label class="full"><?= e($t['contact']['form_msg']) ?>
        <textarea name="message" rows="4" required maxlength="2000" placeholder="<?= e($t['contact']['ph_msg']) ?>"></textarea>
      </label>
      <button class="btn btn-gold" type="submit"><?= e($t['contact']['btn_submit']) ?></button>
      <p class="status" role="status" aria-live="polite"></p>
    </form>
  </div>
</section>
