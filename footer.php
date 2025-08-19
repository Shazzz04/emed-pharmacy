    </main> <!-- close main container -->

    <?php 
        // detect if current page belongs to admin section
        $isAdminPage = strpos($_SERVER['PHP_SELF'], 'admin') !== false; 
    ?>

    <!-- Footer -->
    <footer class="text-center py-3 
        <?php echo $isAdminPage ? 'bg-dark text-light' : 'bg-success text-white'; ?>">
        <div class="container">
            <p class="mb-0">
                <?php if ($isAdminPage): ?>
                    &copy; <?php echo date("Y"); ?> e-Med Pharmacy | Admin Panel
                <?php else: ?>
                    &copy; <?php echo date("Y"); ?> e-Med Pharmacy | All Rights Reserved
                <?php endif; ?>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
