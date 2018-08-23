

guide.pdf: guide-mod.tex main.tex title.tex
	# run pdflatex twice to generate TOC correctly
	pdflatex -halt-on-error main.tex
	pdflatex -halt-on-error main.tex
	mv main.pdf guide.pdf

guide-mod.tex: guide.tex main.tex
	# improve list spacing
	sed 's/\\begin{itemize}/\\begin{itemize}[noitemsep,nolistsep]/' guide.tex > guide-mod.tex
	sed -i 's/\\include{guide}/\\include{guide-mod}/' main.tex

.PHONY: clean pdf

# this target exists for backwards compatibility. It will be removed in version 2.1.
pdf: guide.pdf

clean:
	-rm -f *.aux *.out *.log *.toc guide-mod.tex
