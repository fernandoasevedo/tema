<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Cleriston Dantas
 * Date: 29/03/13
 * Time: 15:35
 * To change this template use File | Settings | File Templates.
 */

if(isset($this->_paginacion)): ?>

    <?php if($this->_paginacion['primeiro']): ?>

        <a href="<?php echo $link . $this->_paginacion['primeiro']; ?>">Primero</a>

    <?php else: ?>

        Primeiro

    <?php endif; ?>

    &nbsp;

    <?php if($this->_paginacion['anterior']): ?>

        <a href="<?php echo $link . $this->_paginacion['anterior']; ?>">Anterior</a>

    <?php else: ?>

        Anterior

    <?php endif; ?>

    &nbsp;

    <?php for($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>

        <?php if($this->_paginacion['atual'] == $this->_paginacion['rango'][$i]): ?>

            <?php echo $this->_paginacion['rango'][$i]; ?>

        <?php else: ?>

            <a href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>">
                <?php echo $this->_paginacion['rango'][$i]; ?>
            </a>&nbsp;

        <?php endif; ?>

    <?php endfor; ?>


    &nbsp;

    <?php if($this->_paginacion['proximo']): ?>

        <a href="<?php echo $link . $this->_paginacion['proximo']; ?>">Próximo</a>

    <?php else: ?>

        Próximo

    <?php endif; ?>

    &nbsp;

    <?php if($this->_paginacion['ultimo']): ?>

        <a href="<?php echo $link . $this->_paginacion['ultimo']; ?>">Último</a>

    <?php else: ?>

        Último

    <?php endif; ?>

<?php endif; ?>