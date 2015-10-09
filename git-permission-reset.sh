git diff -p -R \
    | grep -E '^(diff|(old|new) mode)'  \
    | git apply
