<ul class="nav flex-column nav-underline">
  <?php foreach($links as $link) { ?>
    <li class="nav-item">
      <a class="nav-link <?= $active == $link["nav"]? "active" : "" ?>" aria-current="page" href="<?= $link["href"] ?>"><?= $link["text"] ?></a>
    </li>
  <?php } ?>
</ul>