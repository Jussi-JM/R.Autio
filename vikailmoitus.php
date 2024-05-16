<?php
require 'config.php';
require 'includes/header.php';

if (!isset($_SESSION['sposti']) || !isset($_SESSION['user_role'])) {
    header('Location: login.php');
    exit;
}

$kayttajarooli = $_SESSION['user_role'];
$kayttajaID = $_SESSION['userID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (in_array($kayttajarooli, ['asukas', 'tyontekija', 'isannoitsija']) && isset($_POST['create_report'])) {

        $lisatiedot = filter_var($_POST['lisatiedot'], FILTER_SANITIZE_STRING);
        $prioriteetti = filter_var($_POST['prioriteetti'], FILTER_SANITIZE_STRING);
        
        $stmt = $yhteys->prepare("INSERT INTO vikailmotukset (lisatiedot, prioriteetti, kayttajaID, status) VALUES (:lisatiedot, :prioriteetti, :kayttajaID, 'avoin')");
        $stmt->execute([
            ':lisatiedot' => $lisatiedot,
            ':prioriteetti' => $prioriteetti,
            ':kayttajaID' => $kayttajaID,
        ]);
    } elseif ($kayttajarooli === 'tyontekija' && isset($_POST['update_report'])) {
        $vikaID = filter_var($_POST['vikaID'], FILTER_VALIDATE_INT);
        $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
        $tyontekijaID = filter_var($_POST['tyontekijaID'], FILTER_VALIDATE_INT);

        $stmt = $yhteys->prepare("UPDATE vikailmotukset SET status = :status, tyontekijaID = :tyontekijaID WHERE vikaID = :vikaID");
        $stmt->execute([
            ':status' => $status,
            ':tyontekijaID' => $tyontekijaID,
            ':vikaID' => $vikaID,
        ]);
    }
}

$raportit = [];
if ($kayttajarooli === 'asukas') {
    $stmt = $yhteys->prepare("SELECT * FROM vikailmotukset WHERE kayttajaID = :kayttajaID");
    $stmt->execute([':kayttajaID' => $kayttajaID]);
    $raportit = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif (in_array($userRole, ['isannoitsija', 'tyontekija'])) {
    $stmt = $yhteys->query("SELECT * FROM vikailmotukset");
    $raportit = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<div class="container">
    <h2>Vikailmoitukset</h2>

    <?php if (in_array($kayttajarooli, ['asukas', 'tyontekija', 'isannoitsija'])): ?>
        <h3>Tee uusi vikailmoitus</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="lisatiedot">Lisätiedot:</label>
                <textarea name="lisatiedot" id="lisatiedot" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="prioriteetti">Prioriteetti:</label>
                <select name="prioriteetti" id="prioriteetti" class="form-control" required>
                    <option value="normaali">Normaali</option>
                    <option value="kiireellinen">Kiireellinen</option>
                    <option value="kriittinen">Kriittinen</option>
                </select>
            </div>

            <button type="submit" name="create_report" class="btn btn-primary">Lähetä</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($raportit)): ?>
        <h3>Vikailmoitukset</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lisätiedot</th>
                    <th>Prioriteetti</th>
                    <th>Kayttaja ID</th>
                    <th>Asunnot ID</th>
                    <th>Status</th>
                    <th>Luotu</th>
                    <?php if (in_array($kayttajarooli, ['tyontekija'])): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($raportit as $raportti): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($raportti['vikaID']); ?></td>
                        <td><?php echo htmlspecialchars($raportti['lisatiedot']); ?></td>
                        <td><?php echo htmlspecialchars($raportti['prioriteetti']); ?></td>
                        <td><?php echo htmlspecialchars($raportti['kayttajaID']); ?></td>
                        <td><?php echo htmlspecialchars($raportti['asunnotID']); ?></td>
                        <td><?php echo htmlspecialchars($raportti['status'] === 'avoin' ? 'Avoin' : 'Työn alla'); ?></td>
                        <td><?php echo htmlspecialchars($raportti['luotu']); ?></td>
                        <?php if (in_array($kayttajarooli, ['tyontekija'])): ?>
                            <td>
                                <form method="post" action="" style="display:inline;">
                                    <input type="hidden" name="vikaID" value="<?php echo htmlspecialchars($report['vikaID']); ?>">
                                    <input type="number" name="tyontekijaID" placeholder="Tyontekija ID" class="form-control" required>
                                    <button type="submit" name="update_report" class="btn btn-warning">Päivitä</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Ei vikailmoituksia.</p>
    <?php endif; ?>
</div>

<?php require 'includes/footer.php'; ?>