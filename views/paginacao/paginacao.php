</div>

<?php if (isset($this->_paginacion)): ?>


    <ul class="pagination">
        <li>
            <?php if (isset($this->_paginacion['primero'])): ?>

                <a href="<?php echo $link . $this->_paginacion['primero']; ?>">&laquo;</a>

            <?php else: ?>

                &laquo;

            <?php endif; ?>



            <?php if (isset($this->_paginacion['anterior'])): ?>

                <a href="<?php echo $link . $this->_paginacion['anterior']; ?>">&laquo;&laquo;</a>

            <?php else: ?>

                &laquo;&laquo;

            <?php endif; ?>


            <?php if(isset($this->_paginacion['rango'])):?>
            <?php for ($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>

                <?php if ($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>

                    <?php echo $this->_paginacion['rango'][$i]; ?>

                <?php else: ?>

                    <a class="active" href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>">
                        <?php echo $this->_paginacion['rango'][$i]; ?>
                    </a>&nbsp;

                <?php endif; ?>

            <?php endfor; ?>
            <?php endif; ?>        
            



            <?php if (isset($this->_paginacion['siguiente'])): ?>

                <a href="<?php echo $link . $this->_paginacion['siguiente']; ?>">&raquo;&raquo;</a>

            <?php else: ?>

                &raquo;&raquo;

            <?php endif; ?>



            <?php if (isset($this->_paginacion['ultimo'])): ?>

                <a href="<?php echo $link . $this->_paginacion['ultimo']; ?>">&raquo;</a>

            <?php else: ?>

                &raquo;

            <?php endif; ?>

        <?php endif; ?>

    </li>
</ul>

