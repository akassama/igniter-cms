<?php
//disqus comments
$enableDisqusComments = getConfigData("EnableDisqusComments");
$disqusShortName = rtrim(getConfigData("DisqusShortName"), '/');
?>

<?php
if (strtolower($enableDisqusComments) === "yes") {
?>
<script>
    var disqus_config = function () {
        this.page.url = '<?= current_url() ?>';
        this.page.identifier = '<?= $blog_data['blog_id'] ?>';
        this.page.title = '<?= esc($blog_data['title']) ?>';
    };
    (function() {
        var d = document, s = d.createElement('script');
        s.src = '<?= $disqusShortName ?>/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<?php
}
?>