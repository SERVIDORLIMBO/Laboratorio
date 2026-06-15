<?php
$pagina = $_GET['pagina'] ?? 'inicio';

include __DIR__ . '/conexion-index.php';
$pdo_index = $pdo ?? null;
unset($pdo);
include __DIR__ . '/conexion-login.php';
$pdo_usuarios = $pdo ?? null;
unset($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entidad = $_POST['entidad'] ?? '';
    $accion = $_POST['accion'] ?? '';

    try {
        if ($entidad === 'reactivo' && $pdo_index) {
                if ($accion === 'agregar') {
                $stmt = $pdo_index->prepare('INSERT INTO reactivos (nombre, estado_fisico, cantidad, unidad) VALUES (:nombre, :estado, :cantidad, :unidad)');
                $stmt->execute([':nombre'=>$_POST['nombre'], ':estado'=>$_POST['estado_fisico'], ':cantidad'=>$_POST['cantidad'], ':unidad'=>$_POST['unidad']]);
            } elseif ($accion === 'editar') {
                $stmt = $pdo_index->prepare('UPDATE reactivos SET nombre=:nombre, estado_fisico=:estado, cantidad=:cantidad, unidad=:unidad WHERE id=:id');
                $stmt->execute([':nombre'=>$_POST['nombre'], ':estado'=>$_POST['estado_fisico'], ':cantidad'=>$_POST['cantidad'], ':unidad'=>$_POST['unidad'], ':id'=>$_POST['id']]);
            } elseif ($accion === 'eliminar') {
                $stmt = $pdo_index->prepare('DELETE FROM reactivos WHERE id=:id');
                $stmt->execute([':id'=>$_POST['id']]);
            }
        }

        if ($entidad === 'material' && $pdo_index) {
            if ($accion === 'agregar') {
                $stmt = $pdo_index->prepare('INSERT INTO materiales (nombre, especificacion, cantidad) VALUES (:nombre, :especificacion, :cantidad)');
                $stmt->execute([':nombre'=>$_POST['nombre'], ':especificacion'=>$_POST['especificacion'], ':cantidad'=>$_POST['cantidad']]);
            } elseif ($accion === 'editar') {
                $stmt = $pdo_index->prepare('UPDATE materiales SET nombre=:nombre, especificacion=:especificacion, cantidad=:cantidad WHERE id=:id');
                $stmt->execute([':nombre'=>$_POST['nombre'], ':especificacion'=>$_POST['especificacion'], ':cantidad'=>$_POST['cantidad'], ':id'=>$_POST['id']]);
            } elseif ($accion === 'eliminar') {
                $stmt = $pdo_index->prepare('DELETE FROM materiales WHERE id=:id');
                $stmt->execute([':id'=>$_POST['id']]);
            }
        }

        if ($entidad === 'usuario' && $pdo_usuarios) {
            if ($accion === 'agregar') {
                $stmt = $pdo_usuarios->prepare('INSERT INTO users (nombre, contra) VALUES (:nombre, :contra)');
                $stmt->execute([':nombre'=>$_POST['nombre'], ':contra'=>$_POST['contra']]);
            } elseif ($accion === 'editar') {
                $stmt = $pdo_usuarios->prepare('UPDATE users SET nombre=:nombre, contra=:contra WHERE id=:id');
                $stmt->execute([':nombre'=>$_POST['nombre'], ':contra'=>$_POST['contra'], ':id'=>$_POST['id']]);
            } elseif ($accion === 'eliminar') {
                $stmt = $pdo_usuarios->prepare('DELETE FROM users WHERE id=:id');
                $stmt->execute([':id'=>$_POST['id']]);
            }
        }
    } catch (Exception $e) {
    }

    
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?pagina=' . ($pagina));
    exit;
}

$elementos = [
    ['H', 1, 1, 'reactive'], ['He', 18, 1, 'gas'],
    ['Li', 1, 2, 'alkali'], ['Be', 2, 2, 'metal'], ['B', 13, 2, 'metalloid'], ['C', 14, 2, 'reactive'], ['N', 15, 2, 'reactive'], ['O', 16, 2, 'reactive'], ['F', 17, 2, 'halogen'], ['Ne', 18, 2, 'gas'],
    ['Na', 1, 3, 'alkali'], ['Mg', 2, 3, 'metal'], ['Al', 13, 3, 'metal'], ['Si', 14, 3, 'metalloid'], ['P', 15, 3, 'reactive'], ['S', 16, 3, 'reactive'], ['Cl', 17, 3, 'halogen'], ['Ar', 18, 3, 'gas'],
    ['K', 1, 4, 'alkali'], ['Ca', 2, 4, 'metal'], ['Sc', 3, 4, 'transition'], ['Ti', 4, 4, 'transition'], ['V', 5, 4, 'transition'], ['Cr', 6, 4, 'transition'], ['Mn', 7, 4, 'transition'], ['Fe', 8, 4, 'transition'], ['Co', 9, 4, 'transition'], ['Ni', 10, 4, 'transition'], ['Cu', 11, 4, 'transition'], ['Zn', 12, 4, 'transition'], ['Ga', 13, 4, 'metal'], ['Ge', 14, 4, 'metalloid'], ['As', 15, 4, 'metalloid'], ['Se', 16, 4, 'reactive'], ['Br', 17, 4, 'halogen'], ['Kr', 18, 4, 'gas'],
    ['Rb', 1, 5, 'alkali'], ['Sr', 2, 5, 'metal'], ['Y', 3, 5, 'transition'], ['Zr', 4, 5, 'transition'], ['Nb', 5, 5, 'transition'], ['Mo', 6, 5, 'transition'], ['Tc', 7, 5, 'transition'], ['Ru', 8, 5, 'transition'], ['Rh', 9, 5, 'transition'], ['Pd', 10, 5, 'transition'], ['Ag', 11, 5, 'transition'], ['Cd', 12, 5, 'transition'], ['In', 13, 5, 'metal'], ['Sn', 14, 5, 'metal'], ['Sb', 15, 5, 'metalloid'], ['Te', 16, 5, 'metalloid'], ['I', 17, 5, 'halogen'], ['Xe', 18, 5, 'gas'],
    ['Cs', 1, 6, 'alkali'], ['Ba', 2, 6, 'metal'], ['La', 3, 6, 'lanthanoid'], ['Hf', 4, 6, 'transition'], ['Ta', 5, 6, 'transition'], ['W', 6, 6, 'transition'], ['Re', 7, 6, 'transition'], ['Os', 8, 6, 'transition'], ['Ir', 9, 6, 'transition'], ['Pt', 10, 6, 'transition'], ['Au', 11, 6, 'transition'], ['Hg', 12, 6, 'transition'], ['Tl', 13, 6, 'metal'], ['Pb', 14, 6, 'metal'], ['Bi', 15, 6, 'metal'], ['Po', 16, 6, 'metalloid'], ['At', 17, 6, 'halogen'], ['Rn', 18, 6, 'gas'],
    ['Fr', 1, 7, 'alkali'], ['Ra', 2, 7, 'metal'], ['Ac', 3, 7, 'actinoid'], ['Rf', 4, 7, 'transition'], ['Db', 5, 7, 'transition'], ['Sg', 6, 7, 'transition'], ['Bh', 7, 7, 'transition'], ['Hs', 8, 7, 'transition'], ['Mt', 9, 7, 'transition'], ['Ds', 10, 7, 'transition'], ['Rg', 11, 7, 'transition'], ['Cn', 12, 7, 'transition'], ['Nh', 13, 7, 'metal'], ['Fl', 14, 7, 'metal'], ['Mc', 15, 7, 'metal'], ['Lv', 16, 7, 'metal'], ['Ts', 17, 7, 'halogen'], ['Og', 18, 7, 'gas'],
    ['Ce', 4, 8, 'lanthanoid'], ['Pr', 5, 8, 'lanthanoid'], ['Nd', 6, 8, 'lanthanoid'], ['Pm', 7, 8, 'lanthanoid'], ['Sm', 8, 8, 'lanthanoid'], ['Eu', 9, 8, 'lanthanoid'], ['Gd', 10, 8, 'lanthanoid'], ['Tb', 11, 8, 'lanthanoid'], ['Dy', 12, 8, 'lanthanoid'], ['Ho', 13, 8, 'lanthanoid'], ['Er', 14, 8, 'lanthanoid'], ['Tm', 15, 8, 'lanthanoid'], ['Yb', 16, 8, 'lanthanoid'], ['Lu', 17, 8, 'lanthanoid'],
    ['Th', 4, 9, 'actinoid'], ['Pa', 5, 9, 'actinoid'], ['U', 6, 9, 'actinoid'], ['Np', 7, 9, 'actinoid'], ['Pu', 8, 9, 'actinoid'], ['Am', 9, 9, 'actinoid'], ['Cm', 10, 9, 'actinoid'], ['Bk', 11, 9, 'actinoid'], ['Cf', 12, 9, 'actinoid'], ['Es', 13, 9, 'actinoid'], ['Fm', 14, 9, 'actinoid'], ['Md', 15, 9, 'actinoid'], ['No', 16, 9, 'actinoid'], ['Lr', 17, 9, 'actinoid'],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Quimico</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="pantalla">
        <header class="topbar">
            <h1>Laboratorio Quimico</h1>
        </header>

        <div class="forma">
            <aside class="sidebar">
                <h2>Menú</h2>
                    <ul class="materiales">
                        <li><a href="?pagina=inicio">🏠 Inicio</a></li>
                        <li><a href="?pagina=reactivos">🧪 Reactivos</a></li>
                        <li><a href="?pagina=materiales">🔬 Materiales</a></li>
                        <li><a href="?pagina=usuarios">👤 Usuarios</a></li>
                    </ul>
            </aside>

            <main class="content">

                <?php if($pagina == 'inicio'): ?>
                <h2>Tabla periodica</h2>
                <section class="area-tabla-periodica">
                    <div class="tabla">
                        <div class="tabla-periodica">
                            <?php foreach ($elementos as $indicador => $elemento): ?>
                                <?php [$symbol, $col, $row, $type] = $elemento; ?>
                                <div
                                    class="cuadros <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>"
                                    data-col="<?php echo $indicador + 1; ?>"
                                    style="grid-column: <?php echo (int) $col; ?>; grid-row: <?php echo (int) $row; ?>;"
                                ><?php echo htmlspecialchars($symbol, ENT_QUOTES, 'UTF-8'); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <?php endif; ?>

                <?php if($pagina == 'reactivos'): ?>

                    <h2>Reactivos</h2>

                    <?php
                    $reactivo_editando = null;
                    if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && !empty($_GET['id']) && $pdo_index) {
                        $stmt = $pdo_index->prepare('SELECT * FROM reactivos WHERE id = :id');
                        $stmt->execute([':id' => $_GET['id']]);
                        $reactivo_editando = $stmt->fetch(PDO::FETCH_ASSOC);
                    }

                    $reactivos = [];
                    if ($pdo_index) {
                        $stmt = $pdo_index->query('SELECT * FROM reactivos ORDER BY id ASC');
                        $reactivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                    ?>

                    <table>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Acciones</th>
                    </tr>
                    <?php foreach ($reactivos as $r): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($r['id']); ?></td>
                    <td><?php echo htmlspecialchars($r['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($r['estado_fisico']); ?></td>
                    <td><?php echo htmlspecialchars($r['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($r['unidad']); ?></td>
                    <td>
                        <a href="?pagina=reactivos&accion=editar&id=<?php echo urlencode($r['id']); ?>">Editar</a>
                        <form style="display:inline" method="post">
                            <input type="hidden" name="entidad" value="reactivo">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($r['id']); ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    </table>

                    <?php if ($reactivo_editando): ?>
                        <h3>Editar Reactivo</h3>
                        <form method="post">
                            <input type="hidden" name="entidad" value="reactivo">
                            <input type="hidden" name="accion" value="editar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($reactivo_editando['id']); ?>">
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($reactivo_editando['nombre']); ?>" required>
                            <input type="text" name="estado_fisico" value="<?php echo htmlspecialchars($reactivo_editando['estado_fisico']); ?>">
                            <input type="number" step="any" name="cantidad" value="<?php echo htmlspecialchars($reactivo_editando['cantidad']); ?>">
                            <input type="text" name="unidad" value="<?php echo htmlspecialchars($reactivo_editando['unidad']); ?>">
                            <button type="submit">Guardar cambios</button>
                        </form>
                    <?php else: ?>
                        <h3>Agregar Reactivo</h3>
                        <form method="post">
                            <input type="hidden" name="entidad" value="reactivo">
                            <input type="hidden" name="accion" value="agregar">
                            <input type="text" name="nombre" placeholder="Nombre del reactivo" required>
                            <input type="text" name="estado_fisico" placeholder="Estado físico">
                            <input type="number" step="any" name="cantidad" placeholder="Cantidad">
                            <input type="text" name="unidad" placeholder="Unidad (ej. Litros)">
                            <button type="submit">Guardar</button>
                        </form>
                    <?php endif; ?>

                <?php endif; ?>

                <?php if($pagina == 'materiales'): ?>

                    <h2>Materiales</h2>

                    <?php
                    $material_editando = null;
                    if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && !empty($_GET['id']) && $pdo_index) {
                        $stmt = $pdo_index->prepare('SELECT * FROM materiales WHERE id = :id');
                        $stmt->execute([':id' => $_GET['id']]);
                        $material_editando = $stmt->fetch(PDO::FETCH_ASSOC);
                    }

                    $materiales = [];
                    if ($pdo_index) {
                        $stmt = $pdo_index->query('SELECT * FROM materiales ORDER BY id ASC');
                        $materiales = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                    ?>

                    <table>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especificación</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                    </tr>
                    <?php foreach ($materiales as $m): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($m['id']); ?></td>
                    <td><?php echo htmlspecialchars($m['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($m['especificacion'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($m['cantidad']); ?></td>
                    <td>
                        <a href="?pagina=materiales&accion=editar&id=<?php echo urlencode($m['id']); ?>">Editar</a>
                        <form style="display:inline" method="post">
                            <input type="hidden" name="entidad" value="material">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($m['id']); ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    </table>

                    <?php if ($material_editando): ?>
                        <h3>Editar Material</h3>
                        <form method="post">
                            <input type="hidden" name="entidad" value="material">
                            <input type="hidden" name="accion" value="editar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($material_editando['id']); ?>">
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($material_editando['nombre']); ?>" required>
                            <input type="text" name="especificacion" value="<?php echo htmlspecialchars($material_editando['especificacion'] ?? ''); ?>">
                            <input type="number" name="cantidad" value="<?php echo htmlspecialchars($material_editando['cantidad']); ?>">
                            <button type="submit">Guardar cambios</button>
                        </form>
                    <?php else: ?>
                        <h3>Agregar Material</h3>
                        <form method="post">
                            <input type="hidden" name="entidad" value="material">
                            <input type="hidden" name="accion" value="agregar">
                            <input type="text" name="nombre" placeholder="Nombre del material" required>
                            <input type="text" name="especificacion" placeholder="Especificación">
                            <input type="number" name="cantidad" placeholder="Cantidad">
                            <button type="submit">Guardar</button>
                        </form>
                    <?php endif; ?>

                <?php endif; ?>

                <?php if($pagina == 'usuarios'): ?>

                    <h2>Usuarios</h2>

                    <?php
                    $usuario_editando = null;
                    if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && !empty($_GET['id']) && $pdo_usuarios) {
                        $stmt = $pdo_usuarios->prepare('SELECT * FROM users WHERE id = :id');
                        $stmt->execute([':id' => $_GET['id']]);
                        $usuario_editando = $stmt->fetch(PDO::FETCH_ASSOC);
                    }

                    $usuarios = [];
                    if ($pdo_usuarios) {
                        $stmt = $pdo_usuarios->query('SELECT * FROM users ORDER BY id ASC');
                        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                    ?>

                    <table>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                    </tr>

                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($u['id']); ?></td>
                    <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                    <td>
                        <a href="?pagina=usuarios&accion=editar&id=<?php echo urlencode($u['id']); ?>">Editar</a>
                        <form style="display:inline" method="post">
                            <input type="hidden" name="entidad" value="usuario">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($u['id']); ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    </table>

                    <?php if ($usuario_editando): ?>
                        <h3>Editar Usuario</h3>
                        <form method="post">
                            <input type="hidden" name="entidad" value="usuario">
                            <input type="hidden" name="accion" value="editar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario_editando['id']); ?>">
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario_editando['nombre']); ?>" required>
                            <input type="text" name="contra" value="<?php echo htmlspecialchars($usuario_editando['contra']); ?>" required>
                            <button type="submit">Guardar cambios</button>
                        </form>
                    <?php else: ?>
                        <h3>Agregar Usuario</h3>
                        <form method="post">
                            <input type="hidden" name="entidad" value="usuario">
                            <input type="hidden" name="accion" value="agregar">
                            <input type="text" name="nombre" placeholder="Nombre" required>
                            <input type="text" name="contra" placeholder="Contraseña" required>
                            <button type="submit">Guardar</button>
                        </form>
                    <?php endif; ?>

                <?php endif; ?>
            </main>

        </div>
    </div>
</body>
</html>
