<?php 
$menu["title"] = "Rechercher";
include("main_header.php");
?>
<section>
    <article class="card">
        <div>
            <h2>Introduction</h2><hr>
            <p>
                Comme vous le savez sûrement déjà Storystoire est un site qui permet d'écrire des histoires à choix pour ensuite les poster et les rendre accessibles par tous.
                Qui dit poster une histoire sur internet, à la vue de tous, dit aussi respecter certains standards de communication, de langages mais aussi (et nous en sommes fiers) de mise en page !
                En effet, Storystoire supporte la mise en page HTML pour tout ce qui touche à la rédaction d'histoires et cette page vous permettra, entre autres, de vous informer de quelles sont les différentes possibilités qui s'offrent à vous.
                Ceci est donc une étape cruciale et nécessaire avant de bien comprendre comment fonctionne le site.<br>
                Etant donné nos modestes moyens de production, les histoires seront uniquement rédigées en code HTML ce qui implique par exemple que le retour à la ligne se fera avec la balise <code>&lt;br&gt;</code>.
            </p>
        </div>
    </article>
    <article class='card'>
        <div>
            <h2>Charte d'utilisation</h2><hr>
            <p>
                Ce site est modéré a posteriori, le contenu que vous postez est directement publiés sans aucun contrôle préalable. Il est de votre responsabilité de veiller à ce que vos contributions ne portent pas préjudice à autrui et soient conforment 
                à la réglementation en vigueur. Les organisateurs du site se réservent le droit de retirer toute contribution qu’ils estimeraient déplacée, inappropriée, contraire aux lois et règlements, à cette charte d’utilisation ou susceptible de porter 
                préjudice directement ou non à des tiers. Toute contribution qui n'est pas en relation avec les thèmes de discussion/contenu ou avec l’objet du site peuvent être supprimées sans préavis par les modérateurs.<br><br>
                Seront aussi supprimées, sans préjudice d'éventuelles poursuites disciplinaires ou judiciaires, les contributions qui :
            </p>
            <ul>
                <li>incitent à la discrimination fondée sur la race, le sexe, la religion, à la haine, à la violence, au racisme ou au révisionnisme</li>
                <li>incitent à la commission de délits</li>
                <li>sont contraire à l'ordre public et aux bonnes mœurs,</li>
                <li>font l’apologie des crimes ou délits et particulièrement du meurtre, viol, des crimes de guerre et crimes contre l'humanité,</li>
                <li>ont un caractère injurieux, diffamatoire, insultant ou grossier</li>
                <li>portent manifestement atteinte aux droits d’autrui et particulièrement ceux qui portent atteinte à l'honneur ou à la réputation d'autrui,</li>
                <li>sont liés à un intérêt manifestement commercial ou ont un but promotionnel sans objet avec le site.</li>
            </ul>
            <p>
                L’utilisation d’un pseudonyme ne rend pas anonyme, conformément à la législation les prestataires techniques sont tenus de conserver et de déférer à l’autorité judiciaire les informations de connections (log, IP, date/heure) 
                permettant la poursuite de l’auteur d’une infraction. Toutes les informations nécessaires seront donc conservées pour la durée légale prévue. Elles seront détruites au terme du délai légal de conservation.
                <br><br id='formatage'>Les organisateurs du site se réservent le droit d’exclure du site, de façon temporaire ou définitive, toute personne dont les contributions sont en contradiction avec les règles mentionnées dans le présent document. 
                Les organisateurs pourront transmettre aux autorités de police ou de justice toutes les pièces ou documents postés sur le site s’ils estiment de leur devoir d’informer les autorités compétentes ou que la législation leur en fait obligation.
            </p>
        </div>
    </article>
    <article class='card'>
        <div>
            <h2>Comment rédiger en HTML</h2><hr>
            <h3>Qu'est ce que le HTML ?</h3> 
            <p>
                Le Hypertext Markup Language (HTML) est un language de programmation par balises créé pour représenter les pages web. Il est très (très) largement utilisé à un tel point que toutes les pages internet que vous visionnez 
                depuis votre navigateur sont en fait à la base, du code HTML. C'est un langage qui est très pratique et qui met à disposition des moyens efficaces et performants permettant la mise en page rapide.
                Vous pouvez par exemple afficher le code source d'une page depuis certains navigateur avec la commande Ctrl-U ou Cmd-U.
            </p><br>
            <h3>Où et comment s'en servir sur Storystoire ?</h3>
            <p>Vous aurez accès au langage HTML sur toutes les zones de rédaction d'histoire :</p> 
            <ul>
                <li>Rédaction d'un titre</li>
                <li>Rédaction d'étapes</li>
                <li>Rédaction de description</li>
                <li>Rédaction de choix</li>
            </ul>
            <p>Les balises HTML mises à disposition diffèrent en fonction de la zone dans laquelle vous écrivez. En effet, nous n'allons pas permettre l'insertion d'une image en guise de titre d'histoire ni l'insertion de liens.</p>
            <p>
                Par exemple, si vous souhaitez <i>mettre une partie de votre texte en italique</i> et une autre <b>en gras</b>, vous avez besoin de la basile HTML ouvrante <code>&lt;i&gt;</code> ainsi que de sa balise fermante associée <code>&lt;/i&gt;</code>
                qui délimitent le texte en italique, mais aussi des balises <code>&lt;b&gt;</code> et <code>&lt;/b&gt;</code> pour le texte en gras.
            </p>
            <p>Ainsi, le texte suivant :</p>
            <code class='code'>Lorem ipsum dolor <b>sit amet, consectetur adipiscing elit. </b>Sed non risus. Suspendisse<i> lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.</i> Cras elementum ultrices diam.</code>
            <p>Correspondra au code HTML suivant :</p>
            <code class='code'>Lorem ipsum dolor <code>&lt;b&gt;</code>sit amet, consectetur adipiscing elit. <code>&lt;/b&gt;</code>Sed non risus. Suspendisse<code>&lt;i&gt;</code> lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.<code>&lt;/i&gt;</code> Cras elementum ultrices diam.</code>
            <br><br><h3>Quelles sont les balises disponibles ?</h3>
            <p>Comme dit précédemment, la disponibilité des balises se fait en fonction de la zone d'écriture dans laquelle vous vous trouvez.</p>
            <p>Voici une liste exhaustive de toutes les balises que vous pourrez utiliser sur le site.</p>
            <ul>
                <li>la balise <code>&lt;b&gt;</code> permettant de mettre du texte en gras.</li>
                <li>la balise <code>&lt;i&gt;</code> permettant de mettre du texte en italique.</li>
                <li>la balise <code>&lt;p&gt;</code> pour du text nécessitant une mise en forme, ainsi que sont attribut <code>style</code>.</li>
                <li>la balise générique <code>&lt;span&gt;</code> permettant de styliser un contenu quelconque ainsi que son attribut <code>style</code>.</li>
                <li>la balise <code>&lt;img&gt;</code> ainsi que ses attributs <code>src</code>, <code>alt</code>, <code>width</code>, <code>height</code> permettant d'insérer une image. (Nous ne prennons pas encore en charge l'importation d'images, vous ne pouvez donc insérer que des images déjà existantes sur le web.)</li>
                <li>la balise <code>&lt;font&gt;</code> ainsi que ses attributs <code>style</code>, <code>size</code> et <code>color</code> pour changer la police.</li>
                <li>la balise de liste ordonnée <code>&lt;ol&gt;</code> et non ordonnée <code>&lt;ul&gt;</code> avec bien évidemment la balise <code>&lt;li&gt;</code> pour ajouter un élément.</li>
                <li>ainsi que la balise essentielle <code>&lt;br&gt;</code> qui n'a pas de balise fermante et qui permet de faire un simple retour à la ligne.
                <li>(<code>&lt;br&gt;&lt;br&gt;</code> pour effectuer un saut de ligne)</li>
            </ul>
            <h3>Disponnibilité des balises en fonction des zones</h3>
            <ul>
                <li>Rédaction d'un titre : <code>&lt;b&gt;</code>, <code>&lt;i&gt;</code>, <code>&lt;font&gt;</code></li>
                <li>Rédaction d'étapes : <code>&lt;span&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;i&gt;</code>, <code>&lt;b&gt;</code>, <code>&lt;img&gt;</code>, <code>&lt;font&gt;</code>, <code>&lt;ol&gt;</code>, <code>&lt;ul&gt;</code>, <code>&lt;li&gt;</code>, <code>&lt;br&gt;</code></li>
                <li>Rédaction de description : <code>&lt;span&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;i&gt;</code>, <code>&lt;b&gt;</code>, <code>&lt;font&gt;</code>, <code>&lt;br&gt;</code> et <code>&lt;a&gt;</code> (pour les liens externes, ici uniquement).</li>
                <li>Rédaction de choix : <code>&lt;i&gt;</code>, <code>&lt;b&gt;</code>, <code>&lt;font&gt;</code></li>
            </ul>
            <p>
                Nous vous invitons plus particulièrement à chercher par vous même sur internet afin de savoir comment utiliser les attributs que nous avons cité plus haut. Il existe énormément de bon tutoriels et site explicatifs
                qui vous permettront de vous renseigner d'avantage sur l'utilisation du code HTML.
            </p>
            <hr><p style='text-align:center'>Nous vous souhaitons une bonne lecture/écriture sur notre site Storystoire !<br>- L'équipe -</p>
        </div>
    </article>
</section>
<?php include('footer.php'); ?>